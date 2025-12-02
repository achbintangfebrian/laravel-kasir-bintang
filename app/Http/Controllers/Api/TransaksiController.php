<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiKasir;
use App\Models\TransaksiItem;
use App\Models\Produk;
use App\Models\ProductSale;
use App\Http\Resources\TransaksiKasirResource;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiKasir::with('transaksiItems.produk', 'customer')->get();
        return response()->json([
            'success' => true,
            'message' => 'Transactions retrieved successfully',
            'data' => TransaksiKasirResource::collection($transaksis)
        ]);
    }

    public function store(TransaksiRequest $request)
    {
        // Validate customer exists
        $customer = \App\Models\Customer::find($request->customer_id);
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found',
            ], 404);
        }

        // Calculate total from items
        $total = collect($request->items)->sum('subtotal');

        // Create transaction
        $transaksi = TransaksiKasir::create([
            'customer_id' => $request->customer_id,
            'total' => $total,
        ]);

        // Create transaction items
        foreach ($request->items as $item) {
            TransaksiItem::create([
                'transaction_id' => $transaksi->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);

            // Update product stock
            $produk = Produk::find($item['product_id']);
            if ($produk) {
                $produk->stock -= $item['quantity'];
                $produk->save();
            }

            // Update product sales count
            $productSale = ProductSale::firstOrCreate(
                ['product_id' => $item['product_id']],
                ['total_sold' => 0]
            );
            $productSale->increment('total_sold', $item['quantity']);
        }

        // Load the relationship for the response
        $transaksi->load('transaksiItems.produk', 'customer');

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => new TransaksiKasirResource($transaksi)
        ], 201);
    }

    public function show($id)
    {
        $transaksi = TransaksiKasir::with('transaksiItems.produk', 'customer')->find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaction retrieved successfully',
            'data' => new TransaksiKasirResource($transaksi)
        ]);
    }

    public function destroy($id)
    {
        $transaksi = TransaksiKasir::find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ], 404);
        }

        // Delete transaction items
        $transaksi->transaksiItems()->delete();

        // Delete transaction
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully',
        ]);
    }
}
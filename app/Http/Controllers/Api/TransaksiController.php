<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiKasir;
use App\Models\TransaksiItem;
use App\Models\Produk;
use App\Http\Resources\TransaksiKasirResource;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiKasir::with('transaksiItems.produk')->get();
        return response()->json([
            'success' => true,
            'message' => 'Transactions retrieved successfully',
            'data' => TransaksiKasirResource::collection($transaksis)
        ]);
    }

    public function store(TransaksiRequest $request)
    {
        // Calculate total from items
        $total = collect($request->items)->sum('subtotal');

        // Create transaction
        $transaksi = TransaksiKasir::create([
            'user_id' => $request->user_id,
            'opsi_pay' => $request->opsi_pay,
            'total' => $total,
        ]);

        // Create transaction items
        foreach ($request->items as $item) {
            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $item['produk_id'],
                'jumlah_item' => $item['jumlah_item'],
                'harga_peritem' => $item['harga_peritem'],
                'subtotal' => $item['subtotal'],
            ]);

            // Update product stock
            $produk = Produk::find($item['produk_id']);
            if ($produk) {
                $produk->stok -= $item['jumlah_item'];
                $produk->save();
            }
        }

        // Load the relationship for the response
        $transaksi->load('transaksiItems.produk');

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => new TransaksiKasirResource($transaksi)
        ], 201);
    }

    public function show($id)
    {
        $transaksi = TransaksiKasir::with('transaksiItems.produk')->find($id);

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
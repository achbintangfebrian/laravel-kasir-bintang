<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RekomAi;
use App\Models\Produk;
use App\Models\TransaksiItem;
use App\Models\ProductSale;
use App\Http\Resources\ProdukResource;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index(Request $request)
    {
        // Get top 3 best selling products
        $recommendations = ProductSale::with('product')
            ->orderBy('total_sold', 'desc')
            ->limit(3)
            ->get()
            ->pluck('product');

        // If we don't have enough products from sales, fill with random products
        if ($recommendations->count() < 3) {
            $additionalProducts = Produk::whereNotIn('id', $recommendations->pluck('id')->toArray())
                ->inRandomOrder()
                ->limit(3 - $recommendations->count())
                ->get();
            
            $recommendations = $recommendations->merge($additionalProducts);
        }

        return response()->json([
            'success' => true,
            'message' => 'Recommendations retrieved successfully',
            'data' => ProdukResource::collection($recommendations)
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'produk_id' => 'required|exists:produk,id',
            'action' => 'required|integer',
            'bbot_rekom' => 'required|integer',
        ]);

        $rekomendasi = RekomAi::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Recommendation log created successfully',
            'data' => $rekomendasi
        ], 201);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RekomAi;
use App\Models\Produk;
use App\Models\TransaksiItem;
use App\Http\Resources\ProdukResource;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user_id', null);
        
        // Get recommendations based on user history
        $recommendations = $this->getRecommendations($userId);
        
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

    private function getRecommendations($userId = null)
    {
        // If user ID is provided, get personalized recommendations
        if ($userId) {
            // Get products frequently bought by this user
            $userProducts = TransaksiItem::whereHas('transaksi', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->pluck('produk_id')->toArray();

            if (!empty($userProducts)) {
                // Recommend similar products (same category)
                $categories = Produk::whereIn('id', $userProducts)->pluck('kategori_id')->unique();
                $recommendations = Produk::whereIn('kategori_id', $categories)
                    ->whereNotIn('id', $userProducts)
                    ->limit(10)
                    ->get();
                
                if ($recommendations->count() > 0) {
                    return $recommendations;
                }
            }
        }

        // Fallback: Get most frequently sold products
        $popularProducts = TransaksiItem::select('produk_id')
            ->selectRaw('COUNT(*) as frequency')
            ->groupBy('produk_id')
            ->orderByDesc('frequency')
            ->limit(10)
            ->pluck('produk_id');

        if ($popularProducts->count() > 0) {
            return Produk::whereIn('id', $popularProducts)->get();
        }

        // Final fallback: Get random products
        return Produk::inRandomOrder()->limit(10)->get();
    }
}
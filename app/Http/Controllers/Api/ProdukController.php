<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Http\Resources\ProdukResource;
use App\Http\Requests\ProdukRequest;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => ProdukResource::collection($produks)
        ]);
    }

    public function store(ProdukRequest $request)
    {
        // Validate category exists
        $kategori = \App\Models\KategoriProduk::find($request->category_id);
        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        $produk = Produk::create($request->all());

        // Load the relationship for the response
        $produk->load('kategori');

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => new ProdukResource($produk)
        ], 201);
    }

    public function show($id)
    {
        $produk = Produk::with('kategori')->find($id);

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => new ProdukResource($produk)
        ]);
    }

    public function update(ProdukRequest $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        // Validate category exists if provided
        if ($request->has('category_id')) {
            $kategori = \App\Models\KategoriProduk::find($request->category_id);
            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found',
                ], 404);
            }
        }

        $produk->update($request->all());

        // Load the relationship for the response
        $produk->load('kategori');

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => new ProdukResource($produk)
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }
}
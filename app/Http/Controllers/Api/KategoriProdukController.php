<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Http\Resources\KategoriProdukResource;
use App\Http\Requests\KategoriProdukRequest;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoriProduks = KategoriProduk::all();
        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => KategoriProdukResource::collection($kategoriProduks)
        ]);
    }

    public function store(KategoriProdukRequest $request)
    {
        $kategoriProduk = KategoriProduk::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => new KategoriProdukResource($kategoriProduk)
        ], 201);
    }

    public function show($id)
    {
        $kategoriProduk = KategoriProduk::find($id);

        if (!$kategoriProduk) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category retrieved successfully',
            'data' => new KategoriProdukResource($kategoriProduk)
        ]);
    }

    public function update(KategoriProdukRequest $request, $id)
    {
        $kategoriProduk = KategoriProduk::find($id);

        if (!$kategoriProduk) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        $kategoriProduk->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => new KategoriProdukResource($kategoriProduk)
        ]);
    }

    public function destroy($id)
    {
        $kategoriProduk = KategoriProduk::find($id);

        if (!$kategoriProduk) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        $kategoriProduk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
        ]);
    }
}
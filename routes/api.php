<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\KategoriProdukController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\RekomendasiController;
use App\Http\Controllers\Api\CustomerController;

Route::prefix('v1')->group(function () {
    // Authentication routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Product routes
    Route::apiResource('products', ProdukController::class);

    // Category routes
    Route::apiResource('categories', KategoriProdukController::class);

    // Customer routes
    Route::apiResource('customers', CustomerController::class);

    // Transaction routes
    Route::apiResource('transactions', TransaksiController::class);

    // Recommendation routes
    Route::get('/recommendations', [RekomendasiController::class, 'index']);
    Route::post('/recommendations', [RekomendasiController::class, 'store']);
});
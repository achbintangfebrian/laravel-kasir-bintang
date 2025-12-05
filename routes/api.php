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
    Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth.api');

    // Product routes
    Route::apiResource('products', ProdukController::class)->middleware('auth.api');

    // Category routes
    Route::apiResource('categories', KategoriProdukController::class)->middleware('auth.api');

    // Customer routes
    Route::apiResource('customers', CustomerController::class)->middleware('auth.api');

    // Transaction routes
    Route::apiResource('transactions', TransaksiController::class)->middleware('auth.api');

    // Recommendation routes
    Route::get('/recommendations', [RekomendasiController::class, 'index'])->middleware('auth.api');
    Route::post('/recommendations', [RekomendasiController::class, 'store'])->middleware('auth.api');
});
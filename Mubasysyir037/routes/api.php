<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route Terbuka (Tidak perlu login)
Route::post('login', [AuthController::class, 'login']);

// Route Tertutup (Harus Login / Autentikasi)
Route::middleware('auth:sanctum')->group(function () {
    
    // Semua user yang login (admin & user biasa) bisa melihat, menambah, dan mengubah data
    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    
    // OTORISASI: Hanya user dengan role 'admin' yang bisa menghapus data
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->middleware('role:admin');
    
});

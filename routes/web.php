<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DetailBarangController;


Route::get('/', [HomeController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
// Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/kategori', [KategoriController::class, 'showAvailableProducts']);
Route::get('/kategori/{id}', [KategoriController::class, 'showProductsByCategory']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/detail', [DetailBarangController::class, 'index']);
Route::get('/product/{id}', [DetailBarangController::class, 'show']);



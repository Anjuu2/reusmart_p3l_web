<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;

Route::get('/', [HomeController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
// Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

Route::get('/kategori', [KategoriController::class, 'index']);

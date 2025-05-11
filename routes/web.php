<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AboutController;


Route::get('/', [HomeController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
// Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);


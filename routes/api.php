<?php

use App\Http\Controllers\KurirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriApiController;
use App\Http\Controllers\BarangTitipanController;
use App\Http\Controllers\KategoriController;

Route::post('/login', [LoginController::class, 'loginMobile'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logoutMobile'])->name('logout');
    Route::get('show', [PembeliController::class, 'showM'])->name('pembeli.show');
    Route::get('show', [PenitipController::class, 'showM'])->name('penitip.show');
    Route::get('show', [PegawaiController::class, 'showM'])->name('pegawai.show');
    Route::get('/kurir-index',[KurirController::class, 'index']);
    Route::post('/save-fcm-token-pegawai',[PegawaiController::class, 'saveFcmToken']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/kirim-notifikasi-penitipan', [BarangTitipanController::class, 'kirimNotifikasiMasaPenitipan']);
});

Route::middleware('auth:sanctum')->post('/save-fcm-token-pembeli', [PembeliController::class, 'saveFcmToken']);
Route::middleware('auth:sanctum')->post('/save-fcm-token-penitip', [PenitipController::class, 'saveFcmToken']);

Route::get('barangs/kategori/{id}', [HomeController::class, 'byCategory']);
Route::get('barangs/{id}', [BarangTitipanController::class, 'apiShow']);
Route::get('produk/search', [KategoriController::class, 'apiSearch']);
Route::get('produk', [KategoriController::class, 'apiAllProducts']);
Route::get('/', [HomeController::class, 'index']);
Route::get('barangs', [HomeController::class, 'apiIndex']);
Route::get('kategori', [KategoriController::class, 'apiIndex']);
Route::get('kategori/{id}/produk', [KategoriController::class, 'apiProductsByCategory']);



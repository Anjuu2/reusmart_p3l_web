<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\PembeliController;

Route::post('/login', [LoginController::class, 'loginMobile'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logoutMobile'])->name('logout');
    Route::get('show', [PembeliController::class, 'showM'])->name('pembeli.show');
    Route::get('show', [PenitipController::class, 'showM'])->name('penitip.show');
    Route::get('show', [PegawaiController::class, 'showM'])->name('pegawai.show');
});

Route::middleware('auth:sanctum')->post('/save-fcm-token-pembeli', [PembeliController::class, 'saveFcmToken']);
Route::middleware('auth:sanctum')->post('/save-fcm-token-penitip', [PenitipController::class, 'saveFcmToken']);

use App\Http\Controllers\TestNotificationController;

Route::get('/test-fcm-notification', [TestNotificationController::class, 'sendTestNotification']);

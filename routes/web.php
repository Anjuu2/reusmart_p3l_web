<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganisasiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/organisasi', [OrganisasiController::class, 'index'])
     ->name('organisasi.index');

// Tambahkan route PUT untuk update via AJAX
Route::post('/organisasi/{organisasi}', [OrganisasiController::class, 'update'])
     ->name('organisasi.update');

// (opsional) route POST nonaktif
Route::post('/organisasi/{organisasi}/nonaktif', [OrganisasiController::class, 'nonaktif'])
     ->name('organisasi.nonaktif');
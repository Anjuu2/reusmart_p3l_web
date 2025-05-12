<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\PembeliController;

// Route::post('/PenitipRegister', [PenitipController::class, 'register']);
// Route::post('/PenitipLogin', [PenitipController::class, 'login']);

// Route::post('/OrganisasiRegister', [OrganisasiController::class, 'register']);
// Route::post('/OrganisasiLogin', [OrganisasiController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function (){
//     Route::post('/PenitipLogout', [PenitipController::class, 'logout']);
//     Route::get('/PenitipShow/{id}', [PenitipController::class, 'show']);
//     Route::post('/PenitipUpdate/{id}', [PenitipController::class, 'update']);

//     Route::get('/OrganisasiShow/{id}', [OrganisasiController::class, 'show']);
//     Route::post('/OrganisasiUpdate/{id}', [OrganisasiController::class, 'update']);
//     Route::post('/OrganisasiNonaktif/{id}', [OrganisasiController::class, 'nonaktif']);
//     Route::post('/OrganisasiLogout', [OrganisasiController::class, 'logout']);

//     Route::get('/AlamatIndex', [AlamatController::class, 'index']);
//     Route::post('/AlamatStore', [AlamatController::class, 'store']);
//     Route::get('/AlamatShow/{id}', [AlamatController::class, 'show']);
//     Route::post('/AlamatUpdate/{id}', [AlamatController::class, 'update']);
//     Route::delete('/AlamatDestroy/{id}', [AlamatController::class, 'destroy']);
// });
// Route::get('/OrganisasiIndex', [OrganisasiController::class, 'index']);
// Route::get('/OrganisasiSearch', [OrganisasiController::class, 'search']);

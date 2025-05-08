<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\OrganisasiController;

Route::post('/PenitipRegister', [PenitipController::class, 'register']);
Route::post('/PenitipLogin', [PenitipController::class, 'login']);

Route::post('/OrganisasiRegister', [OrganisasiController::class, 'register']);
Route::post('/OrganisasiLogin', [OrganisasiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/PenitipLogout', [PenitipController::class, 'logout']);
    Route::get('/PenitipShow/{id}', [PenitipController::class, 'show']);
    Route::post('/PenitipUpdate/{id}', [PenitipController::class, 'update']);

    Route::get('/OrganisasiIndex', [OrganisasiController::class, 'index']);
    Route::get('/OrganisasiShow/{id}', [OrganisasiController::class, 'show']);
    Route::post('/OrganisasiUpdate/{id}', [OrganisasiController::class, 'update']);
    Route::post('/OrganisasiNonaktif/{id}', [OrganisasiController::class, 'nonaktif']);
    Route::post('/OrganisasiLogout', [OrganisasiController::class, 'logout']);
});

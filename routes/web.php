<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DetailBarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'showAvailableProducts']);
Route::get('/kategori/{id}', [KategoriController::class, 'showProductsByCategory']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/detail', [DetailBarangController::class, 'index']);
Route::get('/product/{id}', [DetailBarangController::class, 'show']);

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/cek-session', function () {
    return response()->json([
        'session_id' => session()->getId(),        
        'user' => Auth::user(),                    
        'session_data' => session()->all(),        
    ]);
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:pembeli')->get('/dashboard/pembeli', fn() => view('dashboard'))->name('dashboard.pembeli');
Route::middleware('auth:penitip')->get('/dashboard/penitip', fn() => view('dashboardP'))->name('dashboard.penitip');
Route::middleware('auth:organisasi')->get('/dashboard/organisasi', fn() => view('dashboardO'))->name('dashboard.organisasi');
Route::middleware('auth:pegawai')->get('/dashboard/admin', fn() => view('dashboardAdmin'))->name('dashboard.admin');
Route::middleware('auth:pegawai')->get('/dashboard/kurir', fn() => view('dashboard-kurir'))->name('dashboard.kurir');
Route::middleware('auth:pegawai')->get('/dashboard/owner', fn() => view('dashboard-owner'))->name('dashboard.owner');
Route::middleware('auth:pegawai')->get('/dashboard/kepala-gudang', fn() => view('dashboard-kepala'))->name('dashboard.kepala_gudang');
Route::middleware('auth:pegawai')->get('/dashboard/pegawai', fn() => view('dashboard-pegawai'))->name('dashboard.pegawai');

Route::middleware('auth:pembeli')->get('/profile/pembeli', [PembeliController::class, 'profilePembeli'])->name('pembeli.profil');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');


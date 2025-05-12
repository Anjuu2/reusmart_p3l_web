<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PembeliHistoryController;
use App\Http\Controllers\PenitipController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

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
Route::middleware('auth:pegawai')->get('/dashboard/cs', [PenitipController::class, 'index'])->name('dashboard.cs');
Route::middleware('auth:pegawai')->get('/dashboard/pegawai', fn() => view('dashboard-pegawai'))->name('dashboard.pegawai');

Route::middleware('auth:pembeli')->get('/profile/pembeli', [PembeliController::class, 'profilePembeli'])->name('pembeli.profil');
Route::middleware('auth:pembeli')->put('/profile/pembeli/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
Route::middleware('auth:pembeli')->put('/profile/pembeli/status/{id}', [PembeliController::class, 'toggleStatus'])->name('pembeli.toggleStatus');


Route::middleware(['auth:pegawai'])->prefix('cs')->group(function () {
    Route::get('/penitip', [PenitipController::class, 'index'])->name('cs.penitip.index');
    Route::post('/penitip', [PenitipController::class, 'store'])->name('cs.penitip.store');
    Route::put('/penitip/{id}', [PenitipController::class, 'update'])->name('cs.penitip.update');
    Route::delete('/penitip/{id}', [PenitipController::class, 'destroy'])->name('cs.penitip.destroy');
});


Route::post('/logout', function (Request $request) {
    Auth::guard('pembeli')->logout();              
    $request->session()->invalidate();            
    $request->session()->regenerateToken();       

    return redirect('home');                   
})->name('logout');


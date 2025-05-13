<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DetailBarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\BarangTitipanController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PegawaiController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'showAvailableProducts']);
Route::get('/kategori/{id}', [KategoriController::class, 'showProductsByCategory']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/detail', [DetailBarangController::class, 'index']);
Route::get('/product/{id}', [DetailBarangController::class, 'show']);
Route::get('/cari', [BarangTitipanController::class, 'search'])->name('barang.cari');
Route::get('/checkout', [TransaksiController::class, 'index'])->middleware('auth')->name('checkout');

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
// Route::middleware('auth:pegawai')->get('/dashboard/admin', fn() => view('dashboardAdmin'))->name('dashboard.admin');
Route::middleware('auth:pegawai')->get('/dashboard/kurir', fn() => view('dashboard-kurir'))->name('dashboard.kurir');
// Route::middleware('auth:pegawai')->get('/dashboard/owner', fn() => view('dashboard-owner'))->name('dashboard.owner');
Route::middleware('auth:pegawai')->group(function () {
    Route::get('/dashboard/owner', fn() => redirect()->route('owner.donasi.index'))->name('dashboard.owner');
    Route::get('/owner/donasi', [DonasiController::class, 'index'])->name('owner.donasi.index');
    Route::post('/owner/donasi/allocate', [DonasiController::class, 'allocate'])->name('owner.donasi.allocate');
    Route::post('/owner/donasi/update', [DonasiController::class, 'update'])->name('owner.donasi.update');
    Route::post('/owner/donasi/reject', [DonasiController::class, 'reject'])->name('owner.donasi.reject');
    Route::get('/owner/donasi/history-organisasi/{id}', [DonasiController::class, 'historyByOrganisasi'])->name('owner.donasi.history.organisasi');
});

Route::middleware('auth:pegawai')->get('/dashboard/kepala-gudang', fn() => view('dashboard-kepala'))->name('dashboard.kepala_gudang');
Route::middleware('auth:pegawai')->get('/dashboard/pegawai', fn() => view('dashboard-pegawai'))->name('dashboard.pegawai');

Route::middleware('auth:pembeli')->get('/profile/pembeli', [PembeliController::class, 'profilePembeli'])->name('pembeli.profil');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard.admin');

Route::get('/organisasi', [OrganisasiController::class, 'index'])
     ->name('organisasi.index');

// Tambahkan route PUT untuk update via AJAX
Route::post('/organisasi/{organisasi}', [OrganisasiController::class, 'update'])
     ->name('organisasi.update');

// (opsional) route POST nonaktif
Route::post('/organisasi/{organisasi}/nonaktif', [OrganisasiController::class, 'nonaktif'])
     ->name('organisasi.nonaktif');

// Route::get('/pegawai', [PegawaiController::class, 'index'])
//      ->name('pegawai.index');

Route::middleware('auth:pegawai')->group(function () {
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    Route::patch('/pegawai/{id}/nonaktif', [PegawaiController::class, 'nonaktifkan'])->name('pegawai.nonaktifkan');
    Route::patch('/pegawai/{id}/aktifkan', [PegawaiController::class, 'aktifkan'])->name('pegawai.aktifkan');
    Route::get('/pegawai/search', [PegawaiController::class, 'search'])->name('pegawai.search');
});

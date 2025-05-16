<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PembeliHistoryController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\DiskusiController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth:pegawai')->get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard.admin');

Route::middleware('auth:pegawai')->get('/organisasi', [OrganisasiController::class, 'index'])
     ->name('organisasi.index');

// Tambahkan route PUT untuk update via AJAX
Route::middleware('auth:pegawai')->post('/organisasi/{organisasi}', [OrganisasiController::class, 'update'])
     ->name('organisasi.update');

// (opsional) route POST nonaktif
Route::middleware('auth:pegawai')->post('/organisasi/{organisasi}/nonaktif', [OrganisasiController::class, 'nonaktif'])
     ->name('organisasi.nonaktif');

Route::middleware('auth:pegawai')->post('/organisasi/{organisasi}/hapus', [OrganisasiController::class, 'destroy'])
     ->name('organisasi.hapus');

Route::middleware('auth:pegawai')->get('/organisasi/show', [OrganisasiController::class, 'show'])
     ->name('organisasi.show');

Route::get('/lupa-password', function () {
    return view('lupaPassword');
});


Route::post('/organisasi/{organisasi}/changePassword', [OrganisasiController::class, 'ubahPassword'])
->name('ubahPassword');

Route::get('/linkForm', function () {
    return view('emails.kirimLinkForm');
})->name('linkForm');

Route::get('/changePassword', function () {
    return view('lupaPassword');
})->name('changePassword');
Route::post('/changePassword', [PasswordController::class, 'changePassword'])->name('password.ubah');

Route::post('/kirim-link', [PasswordController::class, 'sendLink'])->name('kirim.link');

/////////////////////////////////////////////////

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
Route::get('/register', function () {
    return view('register');
});

Route::post('/register/pembeli', [PembeliController::class, 'store'])->name('pembeli.register');
Route::post('/register/organisasi', [OrganisasiController::class, 'store'])->name('organisasi.register');

Route::middleware('auth:pembeli')->get('/dashboard/pembeli', fn() => view('dashboard'))->name('dashboard.pembeli');
Route::middleware('auth:pembeli')->get('/alamat/pembeli', fn() => view('Pembeli.alamatPembeli'))->name('alamat.pembeli');
Route::middleware('auth:penitip')->get('/dashboard/penitip', fn() => view('dashboardP'))->name('dashboard.penitip');

Route::middleware('auth:pegawai')->get('/dashboard/kurir', fn() => view('dashboard-kurir'))->name('dashboard.kurir');
Route::middleware('auth:pegawai')->get('/dashboard/owner', fn() => view('dashboard-owner'))->name('dashboard.owner');
Route::middleware('auth:pegawai')->get('/dashboard/kepala-gudang', fn() => view('dashboard-kepala'))->name('dashboard.kepala_gudang');
Route::middleware('auth:pegawai')->get('/dashboard/cs', [PenitipController::class, 'index'])->name('dashboard.cs');
Route::middleware('auth:pegawai')->get('/dashboard/pegawai', fn() => view('dashboard-pegawai'))->name('dashboard.pegawai');

Route::middleware('auth:pembeli')->get('/profile/pembeli', [PembeliController::class, 'profilePembeli'])->name('pembeli.profil');
Route::middleware('auth:pembeli')->put('/profile/pembeli/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
Route::middleware('auth:pembeli')->put('/profile/pembeli/status/{id}', [PembeliController::class, 'toggleStatus'])->name('pembeli.toggleStatus');

Route::middleware('auth:penitip')->get('/profile/penitip', [PenitipController::class, 'profilePenitip'])->name('penitip.profil');
Route::middleware('auth:penitip')->put('/profile/penitip/{id}', [PenitipController::class, 'update'])->name('penitip.update');

Route::middleware(['auth:pegawai'])->prefix('cs')->group(function () {
    Route::get('/penitip', [PenitipController::class, 'index'])->name('cs.penitip.index');
    Route::post('/penitip', [PenitipController::class, 'store'])->name('cs.penitip.store');
    Route::put('/penitip/{id}', [PenitipController::class, 'update'])->name('cs.penitip.update');
    Route::delete('/penitip/{id}', [PenitipController::class, 'destroy'])->name('cs.penitip.destroy');
});

Route::get('/diskusi', [DiskusiController::class, 'index'])->name('diskusi.index');
Route::middleware('auth:pembeli')->post('/diskusi/{id_barang}/tanya', [DiskusiController::class, 'storePertanyaan'])->name('diskusi.tanya');
Route::middleware('auth:pegawai')->post('/diskusi/{id_diskusi}/jawab', [DiskusiController::class, 'jawab'])->name('diskusi.jawab');

Route::middleware('auth:pembeli')->group(function () {
    // Route untuk menampilkan data alamat
    Route::get('/alamat', [AlamatController::class, 'index'])->name('alamatPembeli.index');

    // Route untuk menambah alamat baru
    Route::post('/alamat', [AlamatController::class, 'store'])->name('alamat.store');

    // Route untuk memperbarui alamat
    Route::put('/alamat/{id}', [AlamatController::class, 'update'])->name('alamat.update');

    // Route untuk menghapus alamat
    Route::delete('/alamat/{id}', [AlamatController::class, 'destroy'])->name('alamat.destroy');

    // Route untuk menampilkan detail alamat (opsional)
    Route::get('/alamat/{id}', [AlamatController::class, 'show'])->name('alamat.show');
});


Route::post('/logout', function (Request $request) {
    Auth::guard('pembeli')->logout();              
    $request->session()->invalidate();            
    $request->session()->regenerateToken();       

    return redirect('home');                   
})->name('logout');
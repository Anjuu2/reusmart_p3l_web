<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DetailBarangController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PasswordController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PembeliHistoryController;
use App\Http\Controllers\PenitipController;

use App\Http\Controllers\RequestDonasiController;
use Illuminate\Http\Request;
use App\Http\Controllers\BarangTitipanController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PengirimanController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'showAvailableProducts']);
Route::get('/kategori/{id}', [KategoriController::class, 'showProductsByCategory']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/detail', [DetailBarangController::class, 'index']);
Route::get('/product/{id}', [DetailBarangController::class, 'show']);
Route::get('/cari', [BarangTitipanController::class, 'search'])->name('barang.cari');
Route::get('/checkout', [TransaksiController::class, 'index'])->middleware('auth')->name('checkout');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:pembeli')->get('/dashboard/pembeli', fn() => view('dashboard'))->name('dashboard.pembeli');
Route::middleware('auth:penitip')->get('/dashboard/penitip', [BarangTitipanController::class, 'indexPenitip'])->name('dashboard.penitip');
Route::middleware('auth:penitip')->prefix('penitip')->group(function () {
    Route::get('/barang', [BarangTitipanController::class, 'indexPenitip'])->name('penitip.barang.index');
    Route::post('/penitip/barang/{id}/perpanjang', [BarangTitipanController::class, 'perpanjang'])->name('penitip.perpanjang');
    Route::post('/penitip/barang/{id}/ambil', [BarangTitipanController::class, 'ambilBarang'])->name('penitip.ambil');
});

Route::middleware('auth:organisasi')->get('/dashboard/organisasi', fn() => view('dashboardO'))->name('dashboard.organisasi');
Route::middleware('auth:pegawai')->get('/dashboard/admin', fn() => view('dashboardAdmin'))->name('dashboard.admin');
Route::middleware('auth:pegawai')->get('/dashboard/kurir', fn() => view('dashboard-kurir'))->name('dashboard.kurir');
// Route::middleware('auth:pegawai')->get('/dashboard/owner', fn() => view('dashboard-owner'))->name('dashboard.owner');
Route::middleware('auth:pegawai')->group(function () {
    Route::get('/dashboard/owner', fn() => redirect()->route('owner.donasi.index'))->name('dashboard.owner');
    Route::get('/owner/donasi', [DonasiController::class, 'index'])->name('owner.donasi.index');
    Route::post('/owner/donasi/allocate', [DonasiController::class, 'allocate'])->name('owner.donasi.allocate');
    Route::post('/owner/donasi/update', [DonasiController::class, 'update'])->name('owner.donasi.update');
    Route::post('/owner/donasi/reject', [DonasiController::class, 'reject'])->name('owner.donasi.reject');
    Route::get('/owner/donasi/history-organisasi/{id}', [DonasiController::class, 'historyByOrganisasi'])->name('owner.donasi.history.organisasi');

    Route::get('/dashboard/pegawai_gudang', function () {
        return view('pegawai_gudang.dashboard');
    })->name('dashboard.pegawai_gudang');

    Route::get('/pegawaiG/barangTitipan', [BarangTitipanController::class, 'index'])->name('pegawai_gudang.barangTitipan.index');

    Route::get('/pegawaiG/barangTitipan/create', [BarangTitipanController::class, 'createBlank'])->name('pegawai_gudang.barangTitipan.createBlank');
    Route::get('/pegawaiG/barangTitipan/create/{id_penitip}', [BarangTitipanController::class, 'create'])->name('pegawai_gudang.barangTitipan.create');
    Route::get('/pegawaiG/barangTitipan/cariPenitip', [BarangTitipanController::class, 'cariPenitipForm'])->name('pegawai_gudang.barangTitipan.cariPenitip');
    Route::post('/pegawaiG/barangTitipan', [BarangTitipanController::class, 'store'])->name('pegawai_gudang.barangTitipan.store');
    Route::delete('/pegawaiG/barangTitipan/foto-barang/{id}', [BarangTitipanController::class, 'hapusFoto'])->name('fotoBarang.hapus');

    Route::get('/pegawaiG/barangTitipan/{id}/edit', [BarangTitipanController::class, 'edit'])->name('pegawai_gudang.barangTitipan.edit');
    Route::put('/pegawaiG/barangTitipan/{id}', [BarangTitipanController::class, 'update'])->name('pegawai_gudang.barangTitipan.update');
    Route::delete('/pegawaiG/barangTitipan/{id}', [BarangTitipanController::class, 'destroy'])->name('pegawai_gudang.barangTitipan.destroy');
    Route::get('/pegawaiG/barangTitipan/{id}', [BarangTitipanController::class, 'showDetail'])->name('pegawai_gudang.barangTitipan.showDetail');

    Route::get('/barang-pengembalian', [BarangTitipanController::class, 'daftarPengembalian'])->name('pegawai_gudang.barang.pengembalian');
    Route::put('/barang-pengembalian/konfirmasi/{id_barang}', [BarangTitipanController::class, 'konfirmasiPengembalian'])->name('pegawai_gudang.barang.konfirmasiPengembalian');

    // Route::get('/pegawaiG/barangTitipan/create', [BarangTitipanController::class, 'create'])->name('pegawai_gudang.barangTitipan.create');
    Route::get('/pengiriman', [PengirimanController::class, 'index'])->name('pegawai_gudang.pengiriman.index');
    Route::post('/pegawai_gudang/pengiriman/tambah-jadwal', [PengirimanController::class, 'tambahJadwal'])->name('pegawai_gudang.pengiriman.tambahJadwal');
    Route::put('/pegawai_gudang/pengiriman/konfirmasi/{id_jadwal}', [PengirimanController::class, 'konfirmasi'])->name('pegawai_gudang.pengiriman.konfirmasi');
});

Route::middleware('auth:pegawai')->get('/dashboard/kepala-gudang', fn() => view('dashboard-kepala'))->name('dashboard.kepala_gudang');
Route::middleware('auth:pegawai')->get('/dashboard/cs', [PenitipController::class, 'index'])->name('dashboard.cs');
Route::middleware('auth:pegawai')->get('/dashboard/pegawai', fn() => view('dashboard-pegawai'))->name('dashboard.pegawai');

Route::middleware('auth:pembeli')->get('/profile/pembeli', [PembeliController::class, 'profilePembeli'])->name('pembeli.profil');
Route::middleware('auth:pembeli')->put('/profile/pembeli/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
Route::middleware('auth:pembeli')->put('/profile/pembeli/status/{id}', [PembeliController::class, 'toggleStatus'])->name('pembeli.toggleStatus');
Route::middleware('auth:pembeli')->put('/profile/pembeli/riwayat', [PembeliController::class, 'toggleStatus'])->name('pembeli.toggleStatus');

Route::middleware('auth:pembeli')->get('/keranjang', [KeranjangController::class, 'showCart'])->name('keranjang');
Route::middleware('auth:pembeli')->post('/keranjang/tambah', [KeranjangController::class, 'addToCart'])->name('keranjang.tambah');
Route::middleware('auth:pembeli')->post('/keranjang/{id}', [KeranjangController::class, 'removeFromCart'])->name('keranjang.hapus');

Route::middleware(['auth:pegawai'])->prefix('cs')->group(function () {
    Route::get('/penitip', [PenitipController::class, 'index'])->name('cs.penitip.index');
    Route::post('/penitip', [PenitipController::class, 'store'])->name('cs.penitip.store');
    Route::put('/penitip/{id}', [PenitipController::class, 'update'])->name('cs.penitip.update');
    Route::delete('/penitip/{id}', [PenitipController::class, 'destroy'])->name('cs.penitip.destroy');
});

Route::middleware(['auth:organisasi'])->prefix('organisasi')->group(function () {
    Route::get('/request-donasi', [RequestDonasiController::class, 'index'])->name('organisasi.request.index');
    Route::post('/request-donasi', [RequestDonasiController::class, 'store'])->name('organisasi.request.store');
    Route::put('/request-donasi/{id}', [RequestDonasiController::class, 'update'])->name('organisasi.request.update');
    Route::delete('/request-donasi/{id}', [RequestDonasiController::class, 'destroy'])->name('organisasi.request.destroy');
});

Route::post('/logout', function (Request $request) {
    Auth::guard('pembeli')->logout();              
    $request->session()->invalidate();            
    $request->session()->regenerateToken();       

    return redirect('home');                   
})->name('logout');

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

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\DiskusiController;

// Route::get('/', function () {
//     return view('home');
// });

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

Route::get('/cek-session', function () {
    return response()->json([
        'session_id' => session()->getId(),        
        'user' => Auth::user(),                    
        'session_data' => session()->all(),        
    ]);
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/register/pembeli', [PembeliController::class, 'store'])->name('pembeli.register');
Route::post('/register/organisasi', [OrganisasiController::class, 'store'])->name('organisasi.register');

Route::middleware('auth:pembeli')->get('/alamat/pembeli', fn() => view('Pembeli.alamatPembeli'))->name('alamat.pembeli');

Route::middleware('auth:penitip')->get('/profile/penitip', [PenitipController::class, 'profilePenitip'])->name('penitip.profil');
Route::middleware('auth:penitip')->put('/profile/penitip/{id}', [PenitipController::class, 'update'])->name('penitip.update');

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
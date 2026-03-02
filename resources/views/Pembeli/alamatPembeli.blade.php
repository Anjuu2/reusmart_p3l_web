<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Pembeli | ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --color-primary: #10b981; 
            --color-primary-dark: #059669;
            --color-secondary: #0f172a; 
            --color-accent: #f59e0b; 
            --color-bg: #f8fafc; 
            --color-surface: #ffffff;
            --color-text-main: #1e293b;
            --color-text-light: #64748b;
            --color-border: #e2e8f0;
            
            --gradient-primary: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-pill: 9999px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--color-text-main);
            background-color: var(--color-bg);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        a { text-decoration: none; color: inherit; }

        /* HEADER & NAVBAR (Unified) */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.3);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .brand-logo { width: 42px; height: 42px; border-radius: 12px; object-fit: cover; box-shadow: var(--shadow-sm); }
        .brand-text { font-size: 1.5rem; color: var(--color-secondary); margin: 0; letter-spacing: -0.5px;}
        .brand-text span { color: var(--color-primary); }

        .nav-links { display: flex; gap: 32px; margin: 0; padding: 0; list-style: none; }
        .nav-links a { font-weight: 600; font-size: 0.95rem; color: var(--color-text-light); transition: color 0.2s; position: relative;}
        .nav-links a:hover, .nav-links a.active { color: var(--color-secondary); }
        .nav-links a::after { content: ''; position: absolute; width: 0; height: 2px; bottom: -5px; left: 0; background: var(--gradient-primary); transition: width 0.3s ease; border-radius: 2px;}
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }

        .nav-actions { display: flex; align-items: center; gap: 12px; }
        .action-btn {
            width: 44px; height: 44px; border-radius: var(--radius-pill); background: var(--color-surface);
            display: flex; align-items: center; justify-content: center; color: var(--color-text-main);
            font-size: 1.2rem; border: 1px solid var(--color-border); transition: all 0.2s ease;
        }
        .action-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);}

        /* Main Content Container */
        .main-container {
            flex: 1;
            padding: 40px 0;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }
        .page-title span { color: var(--color-primary); }

        .btn-back {
            background: var(--color-surface);
            color: var(--color-text-main);
            border: 1px solid var(--color-border);
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover { background: #f1f5f9; transform: translateX(-3px); }

        /* Profile Mini Header */
        .profile-mini {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
        }
        .profile-avatar { width: 70px; height: 70px; border-radius: 50%; border: 3px solid #f1f5f9; object-fit: cover;}
        .profile-name { font-size: 1.4rem; font-weight: 800; color: var(--color-secondary); margin: 0; font-family: 'Outfit', sans-serif;}
        .profile-email { color: var(--color-text-light); font-size: 0.95rem; margin: 0; }

        /* Address Cards */
        .address-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }
        .address-card:hover {  transform: translateY(-2px); box-shadow: var(--shadow-md); border-color: #cbd5e1; }
        
        /* Decorative Tag */
        .address-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: var(--color-primary); }

        .address-body {
            padding: 24px 24px 24px 34px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        @media (min-width: 768px) {
            .address-body { flex-direction: row; justify-content: space-between; align-items: flex-start; }
            .address-info { flex: 1; padding-right: 20px;}
            .address-form { flex: 1; border-left: 1px solid var(--color-border); padding-left: 20px; }
        }

        .address-line { display: flex; margin-bottom: 8px; font-size: 0.95rem; }
        .address-label { width: 100px; color: var(--color-text-light); font-weight: 600; flex-shrink: 0;}
        .address-value { font-weight: 600; color: var(--color-text-main); }

        .btn-custom {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-custom:hover { background: var(--color-primary-dark); color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16,185,129,0.2); }
        
        .btn-outline-custom {
            background: transparent;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            padding: 8px 20px;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-outline-custom:hover { background: var(--color-primary); color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16,185,129,0.2); }

        .btn-link-danger {
            color: #ef4444; background: transparent; border: none; font-weight: 600; padding: 0; font-size: 0.9rem; transition: color 0.2s; display: inline-flex; align-items: center; gap: 4px;
        }
        .btn-link-danger:hover { color: #b91c1c; text-decoration: underline; }

        .btn-update {
            background: #fffbeb; color: #d97706; border: 1px solid #fcd34d; padding: 8px 18px; border-radius: var(--radius-md); font-weight: 600; font-size: 0.9rem; transition: all 0.2s; display: inline-flex; align-items: center; width: 100%; justify-content: center;
        }
        .btn-update:hover { background: #fef3c7; color: #b45309; }

        .form-control {
            border-radius: 8px;
            padding: 10px 14px;
            border: 1px solid var(--color-border);
            font-size: 0.9rem;
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background: white; border-color: var(--color-primary); box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .alert-custom { border-radius: 12px; border: none; border-left: 4px solid var(--color-primary); background: #ecfdf5; color: #065f46; font-weight: 600; }

        /* Empty State */
        .empty-state { text-align: center; padding: 60px 20px; background: var(--color-surface); border-radius: var(--radius-lg); border: 1px dashed #cbd5e1; margin-bottom: 24px;}
        .empty-state i { font-size: 4rem; color: #cbd5e1; margin-bottom: 20px; }
        .empty-state h3 { color: var(--color-secondary); font-weight: 700; }
        .empty-state p { color: var(--color-text-light); margin-bottom: 24px; }

        /* Modals */
        .modal-content { border-radius: var(--radius-lg); border: none; box-shadow: var(--shadow-lg); overflow: hidden;}
        .modal-header { background: var(--color-bg); border-bottom: 1px solid var(--color-border); padding: 20px 25px; }
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); }
        .modal-body { padding: 30px; }
        .form-label { font-weight: 600; color: var(--color-text-main); font-size: 0.9rem; margin-bottom: 6px; }

        /* FOOTER */
        .footer { background: var(--color-surface); border-top: 1px solid var(--color-border); padding: 40px 0 20px; margin-top: auto; }
        .footer-brand .brand-logo { width: 36px; height: 36px; }
        .footer-text { color: var(--color-text-light); font-size: 0.95rem; line-height: 1.6; }
        .social-links { display: flex; gap: 12px; margin-top: 20px; }
        .social-link { width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: var(--color-text-main); font-size: 1.1rem; transition: all 0.3s; }
        .social-link:hover { background: var(--color-primary); color: white; transform: translateY(-3px); }
        .footer-bottom { border-top: 1px solid var(--color-border); margin-top: 30px; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;}
        .footer-bottom p { margin: 0; color: var(--color-text-light); font-size: 0.9rem; }

    </style>
</head>
<body>

<!-- NAVBAR GLASS -->
<nav class="navbar-glass">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="d-flex align-items-center gap-2 text-decoration-none" href="{{ url('/') }}">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
            <span class="brand-text d-none d-sm-block">ReUse<span>Mart</span></span>
        </a>
        
        <ul class="nav-links d-none d-md-flex">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/kategori') }}">Koleksi</a></li>
            <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
        </ul>

        <div class="nav-actions">
            <a href="{{ route('keranjang') }}" class="action-btn text-decoration-none" title="Keranjang">
                <i class="bi bi-cart3"></i>
            </a>
            <a href="{{ route('pembeli.profil') }}" class="action-btn text-decoration-none" title="Akun Saya" style="background: var(--color-primary); color: white; border-color: var(--color-primary); box-shadow: var(--shadow-glow);">
                <i class="bi bi-person-fill"></i>
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-container">

    @if(session('success'))
        <div class="alert alert-custom alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 bg-success text-white rounded-circle p-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-header">
        <div>
            <h1 class="page-title">Buku <span>Alamat</span></h1>
            <p class="text-muted mt-2 mb-0">Kelola alamat pengiriman Anda untuk pengalaman belanja yang lebih cepat.</p>
        </div>
        <a href="{{ route('pembeli.profil') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Profil
        </a>
    </div>

    <!-- Mini Profile Summary -->
    <div class="profile-mini">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($pembeli->nama_pembeli) }}&background=e2e8f0&color=0f172a&bold=true" alt="User" class="profile-avatar">
        <div>
            <h4 class="profile-name">{{ $pembeli->nama_pembeli }}</h4>
            <p class="profile-email"><i class="bi bi-envelope me-1"></i> {{ $pembeli->email }}</p>
        </div>
        <div class="ms-auto">
             <button type="button" class="btn-custom" data-bs-toggle="modal" data-bs-target="#tambahAlamatModal">
                <i class="bi bi-plus-lg"></i> Tambah Alamat Baru
            </button>
        </div>
    </div>

    <!-- Address Cards -->
    @forelse ($alamat as $almt)
    <div class="address-card">
        <div class="address-body">
            <!-- Left Info -->
            <div class="address-info">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-geo-alt-fill text-primary me-2"></i> Tinjauan Alamat</h5>
                
                <div class="address-line">
                    <span class="address-label">Provinsi</span>
                    <span class="address-value">{{ $almt->provinsi }}</span>
                </div>
                <div class="address-line">
                    <span class="address-label">Kota</span>
                    <span class="address-value">{{ $almt->kota }}</span>
                </div>
                <div class="address-line">
                    <span class="address-label">Kecamatan</span>
                    <span class="address-value">{{ $almt->kecamatan }}</span>
                </div>
                <div class="address-line">
                    <span class="address-label">Kelurahan</span>
                    <span class="address-value">{{ $almt->kelurahan }}</span>
                </div>
                <div class="address-line">
                    <span class="address-label">Kodepos</span>
                    <span class="address-value">{{ $almt->kode_pos }}</span>
                </div>
                <div class="address-line mt-3">
                    <span class="address-label">Jalan</span>
                    <span class="address-value">{{ $almt->jalan }}</span>
                </div>
                <div class="address-line">
                    <span class="address-label">Detail</span>
                    <span class="address-value text-muted">{{ $almt->detail ?? '-' }}</span>
                </div>

                <form action="{{ route('alamat.destroy', $almt->id_alamat_pembeli) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-link-danger"><i class="bi bi-trash3"></i> Hapus Alamat</button>
                </form>
            </div>

            <!-- Right Update Form -->
            <div class="address-form mt-4 mt-md-0">
                <h6 class="fw-bold mb-3 text-secondary"><i class="bi bi-pencil-square me-2"></i> Perbarui Alamat Ini</h6>
                <form action="{{ route('alamat.update', $almt->id_alamat_pembeli) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-2">
                        <div class="col-6 mb-2">
                            <input type="text" name="provinsi" class="form-control" value="{{ $almt->provinsi }}" placeholder="Provinsi" required>
                        </div>
                        <div class="col-6 mb-2">
                            <input type="text" name="kota" class="form-control" value="{{ $almt->kota }}" placeholder="Kota/Kab" required>
                        </div>
                        <div class="col-6 mb-2">
                            <input type="text" name="kecamatan" class="form-control" value="{{ $almt->kecamatan }}" placeholder="Kecamatan" required>
                        </div>
                        <div class="col-6 mb-2">
                            <input type="text" name="kelurahan" class="form-control" value="{{ $almt->kelurahan }}" placeholder="Kelurahan" required>
                        </div>
                        <div class="col-8 mb-2">
                            <input type="text" name="jalan" class="form-control" value="{{ $almt->jalan }}" placeholder="Nama Jalan" required>
                        </div>
                        <div class="col-4 mb-2">
                            <input type="text" name="kode_pos" class="form-control" value="{{ $almt->kode_pos }}" placeholder="Kodepos" required>
                        </div>
                        <div class="col-12 mb-3">
                            <textarea name="detail" class="form-control" rows="2" placeholder="Detail Lokasi / Patokan (Opsional)">{{ $almt->detail }}</textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-update"><i class="bi bi-cloud-arrow-up me-1"></i> Simpan Pembaruan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty
        <div class="empty-state">
            <i class="bi bi-geo-alt"></i>
            <h3>Belum Ada Alamat</h3>
            <p>Anda belum menyimpan alamat pengiriman apa pun. Tambahkan sekarang untuk mempermudah checkout.</p>
            <button type="button" class="btn-custom" data-bs-toggle="modal" data-bs-target="#tambahAlamatModal">
                <i class="bi bi-plus-lg"></i> Tambah Alamat Pertama
            </button>
        </div>
    @endforelse

</div>

<!-- Modal Tambah Alamat -->
<div class="modal fade" id="tambahAlamatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('alamat.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-house-add text-primary me-2"></i>Tambah Alamat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="card border-0 shadow-sm p-3 mb-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" placeholder="Contoh: Jawa Timur" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kota / Kabupaten</label>
                            <input type="text" name="kota" class="form-control" placeholder="Contoh: Surabaya" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" placeholder="Contoh: Gubeng" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" placeholder="Contoh: Airlangga" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Nama Jalan</label>
                            <input type="text" name="jalan" class="form-control" placeholder="Contoh: Jl. Dharmawangsa No. 12" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control" placeholder="Contoh: 60286" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Detail / Patokan (Opsional)</label>
                            <textarea class="form-control" name="detail" rows="2" placeholder="Contoh: Pagar hitam, depan indomaret"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 bg-light">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border bg-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn-custom m-0">Simpan Alamat Baru</button>
            </div>
        </form>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer mt-auto">
    <div class="container">
        <div class="row pt-2 pb-3">
            <div class="col-lg-5">
                <div class="footer-brand mb-3">
                    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                        <img src="{{ asset('images/logo2.png') }}" alt="ReUseMart" class="brand-logo">
                        <h2 class="brand-text m-0 fs-4">ReUse<span>Mart</span></h2>
                    </a>
                </div>
                <p class="footer-text">Platform terpercaya untuk jual beli dan donasi barang bekas berkualitas. Mari ciptakan lingkungan yang lebih baik bersama kami.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 ReUseMart. All rights reserved.</p>
            <div class="d-flex gap-4">
                <a href="#" class="text-decoration-none footer-text">Kebijakan Privasi</a>
                <a href="#" class="text-decoration-none footer-text">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Penitip | ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        
        .user-profile-btn {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 50px;
            padding: 5px 15px 5px 5px;
            color: var(--color-text-main);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .user-profile-btn:hover { background: #f1f5f9; color: var(--color-primary-dark); }
        .user-profile-btn img { width: 32px; height: 32px; border-radius: 50%; }

        /* PROFILE LAYOUT */
        .profile-wrapper {
            max-width: 900px;
            margin: 40px auto 60px;
        }

        .profile-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            position: relative;
        }

        .profile-header {
            background: var(--gradient-primary);
            padding: 40px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        
        /* Glass decorative elements */
        .profile-header::after {
            content: ''; position: absolute; top: -50px; right: -50px; width: 200px; height: 200px;
            background: rgba(255,255,255,0.1); border-radius: 50%; filter: blur(20px); pointer-events: none;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            object-fit: cover;
            background: white;
            box-shadow: var(--shadow-lg);
            padding: 4px;
        }

        .profile-name { font-size: 1.8rem; font-family: 'Outfit', sans-serif; font-weight: 800; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .profile-email { font-size: 1rem; color: rgba(255,255,255,0.9); margin: 5px 0 0; }
        .profile-badge {
            background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: white;
            padding: 6px 12px; border-radius: var(--radius-pill); font-size: 0.8rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: 6px; margin-top: 10px; border: 1px solid rgba(255,255,255,0.3);
        }

        .btn-back-header {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            z-index: 1; /* Above glass decorative */
        }
        .btn-back-header:hover { background: rgba(255,255,255,0.3); color: white; transform: translateX(-3px); }

        .profile-body {
            padding: 40px;
        }

        .section-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-title i { color: var(--color-primary); }

        .form-label {
            font-weight: 600;
            color: var(--color-text-main);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        
        .form-control[disabled] {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: var(--color-text-light);
            font-weight: 500;
        }

        .stat-box {
            background: #f1fdfaa6;
            border: 1px solid #d1fae5;
            padding: 15px 20px;
            border-radius: var(--radius-md);
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .stat-label { font-size: 0.85rem; color: #047857; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;}
        .stat-value { font-size: 1.5rem; font-weight: 800; color: var(--color-primary-dark); font-family: 'Outfit', sans-serif;}

        .profile-actions {
            background: #f8fafc;
            padding: 25px 40px;
            border-top: 1px solid var(--color-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

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

        .btn-danger-custom {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fca5a5;
            padding: 10px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-danger-custom:hover { background: #ef4444; color: white; border-color: #ef4444; }

        /* ALERTS */
        .alert-custom {
            border-radius: 12px;
            border: none;
            border-left: 4px solid var(--color-primary);
            background: #ecfdf5;
            color: #065f46;
            font-weight: 600;
        }

        /* MODALS */
        .modal-content { border-radius: var(--radius-lg); border: none; box-shadow: var(--shadow-lg); overflow: hidden;}
        .modal-header { background: var(--color-bg); border-bottom: 1px solid var(--color-border); padding: 20px 25px; }
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); }
        .modal-body { padding: 30px; }
        
        .form-control {
            border-radius: var(--radius-md);
            padding: 12px 16px;
            border: 1px solid var(--color-border);
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .history-card {
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            margin-bottom: 15px;
            box-shadow: var(--shadow-sm);
            background: white;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .history-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); border-color: #cbd5e1; }
        .history-header {
            background: #f8fafc;
            padding: 12px 16px;
            border-bottom: 1px solid var(--color-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--color-text-light);
        }
        .history-status { font-weight: 700; color: #0284c7; background: #e0f2fe; padding: 4px 10px; border-radius: var(--radius-pill); }
        .history-body { padding: 16px; display: flex; justify-content: space-between; align-items: center; }
        .history-title { font-weight: 700; color: var(--color-text-main); font-size: 1.05rem; margin-bottom: 4px; }
        .history-price { font-weight: 800; color: var(--color-primary-dark); font-size: 1.1rem; }

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
        
        <div class="dropdown ms-auto">
            <a href="#" class="user-profile-btn text-decoration-none" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ Auth::guard('penitip')->user()->nama ?? 'User' }}&background=f1f5f9&color=10b981&bold=true" alt="Profile">
                <span class="d-none d-sm-inline ms-1">{{ Auth::guard('penitip')->user()->nama ?? 'Akun Saya' }}</span>
                <i class="bi bi-chevron-down ms-1 text-muted" style="font-size: 0.8rem;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" aria-labelledby="dropdownUser">
                <li>
                    <a class="dropdown-item py-2 fw-semibold" href="{{ route('dashboard.penitip') }}">
                        <i class="bi bi-speedometer2 me-2 text-muted"></i> Dashboard Penitip
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item py-2 text-danger fw-semibold" onclick="
                        if(confirm('Yakin ingin logout?')) {
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        } else {
                            event.preventDefault();
                        }
                    ">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container flex-grow-1">
    <div class="profile-wrapper">
        
        @if(session('success'))
            <div class="alert alert-custom alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2 bg-success text-white rounded-circle p-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="profile-card">
            <!-- HEADER -->
            <div class="profile-header">
                <div class="d-flex align-items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($penitip->nama_penitip) }}&background=ffffff&color=059669&bold=true&size=128" alt="User" class="profile-avatar">
                    <div style="z-index: 1;">
                        <h4 class="profile-name">{{ $penitip->nama_penitip }}</h4>
                        <p class="profile-email"><i class="bi bi-envelope me-1"></i> {{ $penitip->email }}</p>
                        <div class="profile-badge">
                            <i class="bi {{ $penitip->status_aktif ? 'bi-shield-check text-white' : 'bi-shield-x text-danger' }}"></i>
                            {{ $penitip->status_aktif ? 'Akun Aktif' : 'Tidak Aktif' }}
                        </div>
                    </div>
                </div>
                <a href="{{ route('dashboard.penitip') }}" class="btn-back-header">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- BODY -->
            <div class="profile-body">
                <h5 class="section-title"><i class="bi bi-person-lines-fill"></i> Data Diri & Akun</h5>
                
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" value="{{ $penitip->nama_penitip }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-at text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" value="{{ $penitip->username }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Alamat / Lokasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-geo-alt text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" value="{{ $penitip->alamat }}" disabled>
                        </div>
                    </div>
                </div>

                <h5 class="section-title"><i class="bi bi-graph-up-arrow"></i> Statistik Performa</h5>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="stat-box">
                            <span class="stat-label">Saldo Saat Ini</span>
                            <span class="stat-value">Rp{{ number_format($penitip->saldo_penitip ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box">
                            <span class="stat-label">Total Poin</span>
                            <span class="stat-value text-warning"><i class="bi bi-star-fill fs-5 me-1"></i>{{ $penitip->poin ?? 0 }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box">
                            <span class="stat-label">Rating Rata-rata</span>
                            <span class="stat-value">{{ number_format($avgRating ?? 0, 2) }} <span style="font-size: 1rem; color: #64748b;">/ 5.0</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="profile-actions">
                <div class="d-flex gap-3 flex-wrap">
                    <button type="button" class="btn-custom" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square"></i> Edit Profil
                    </button>
                    <button type="button" class="btn-outline-custom" data-bs-toggle="modal" data-bs-target="#historyModal">
                        <i class="bi bi-receipt"></i>  Riwayat Penjualan
                    </button>
                </div>
                <!-- 
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                    @csrf
                    <button type="submit" class="btn-danger-custom">Log Out <i class="bi bi-box-arrow-right"></i></button>
                </form> 
                -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('penitip.update', $penitip->id_penitip) }}" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Profil Saya</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_penitip" class="form-control" value="{{ $penitip->nama_penitip }}" required placeholder="Masukkan nama lengkap">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $penitip->username }}" required placeholder="Username unik">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $penitip->email }}" required placeholder="nama@email.com">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat Lengkap</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $penitip->alamat }}" required placeholder="Nama jalan, kota, kodepos">
                </div>
            </div>
            <div class="alert alert-warning mt-4 mb-0 d-flex align-items-center pb-2 pt-2 rounded-3 border-0" style="background: #fffbeb; color: #92400e; font-size: 0.85rem;">
                <i class="bi bi-info-circle-fill me-2 fs-5"></i> 
                Pastikan data yang Anda masukkan adalah benar dan valid untuk keperluan pencairan dana.
            </div>
        </div>
        <div class="modal-footer border-0 p-4 pt-2">
            <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn-custom m-0">Simpan Perubahan</button>
        </div>
        </form>
    </div>
</div>

<!-- Modal Riwayat Penjualan -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-receipt text-primary me-2"></i>Riwayat Barang Terjual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body bg-light">
                @forelse ($transaksiList as $transaksi)
                    <div class="history-card">
                        <div class="history-header">
                            <div><i class="bi bi-calendar-check me-1"></i> Tgl Keluar: {{ \Carbon\Carbon::parse($transaksi->tanggal_keluar)->locale('id')->isoFormat('D MMM YYYY, H:mm') }}</div>
                            <div class="history-status">{{ $transaksi->status_barang }}</div>
                        </div>
                        <div class="history-body">
                            <div>
                                <h6 class="history-title">{{ $transaksi->nama_barang }}</h6>
                                <p class="text-muted mb-0" style="font-size: 0.85rem;"><i class="bi bi-check-circle-fill text-success me-1"></i> Transaksi Berhasil</p>
                            </div>
                            <div class="text-end">
                                <span class="d-block text-muted" style="font-size: 0.8rem;">Nominal Terjual</span>
                                <div class="history-price">Rp{{ number_format($transaksi->harga_jual, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-receipt mb-3 d-block" style="font-size: 3rem; color: #cbd5e1;"></i>
                        <h5 class="text-secondary fw-bold font-outfit">Belum Ada Transaksi</h5>
                        <p class="text-muted">Barang Anda belum ada yang terjual, atau riwayat masih kosong.</p>
                    </div>
                @endforelse
            </div>
        </div>
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
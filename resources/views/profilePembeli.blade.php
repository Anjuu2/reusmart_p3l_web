<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pembeli - ReUseMart</title>

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
            --color-primary-light: #d1fae5;
            --color-secondary: #0f172a;
            --color-bg: #f8fafc;
            --color-surface: #ffffff;
            --color-text: #334155;
            --color-text-light: #64748b;
            --color-border: #e2e8f0;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-pill: 50px;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.02);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.6;
            padding-top: 80px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); }

        /* ========= NAVIGATION ========= */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            height: 80px;
        }

        .navbar-brand { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: var(--color-secondary); display: flex; align-items: center; gap: 10px;}
        .navbar-brand img { height: 40px; }
        .navbar-brand span { color: var(--color-primary); }

        .nav-link { font-weight: 600; color: var(--color-text); padding: 0.5rem 1.2rem; border-radius: var(--radius-pill); transition: all 0.3s ease; font-size: 0.95rem;}
        .nav-link:hover, .nav-link.active { color: var(--color-primary); background: rgba(16, 185, 129, 0.08); }

        .btn-logout { background: #fee2e2; color: #ef4444; border-radius: var(--radius-pill); font-weight: 600; padding: 0.5rem 1.5rem; transition: all 0.3s; border: none;}
        .btn-logout:hover { background: #ef4444; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);}

        /* ========= HEADER & PROFILE ========= */
        .profile-header {
            background: linear-gradient(135deg, var(--color-secondary) 0%, #1e293b 100%);
            border-radius: var(--radius-lg);
            padding: 40px;
            color: white;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        .profile-header::after {
            content: ''; position: absolute; top: -50%; right: -10%; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%); border-radius: 50%; pointer-events: none;
        }
        
        .profile-user-info { display: flex; align-items: center; gap: 20px; position: relative; z-index: 1;}
        .profile-avatar { width: 90px; height: 90px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.2); background: white; padding: 5px; object-fit: cover;}
        .profile-details h2 { color: white; margin-bottom: 5px; font-size: 2rem;}
        .profile-details p { color: #94a3b8; margin: 0; font-size: 1.1rem; display: flex; align-items: center; gap: 8px;}

        .point-badge { background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.5); color: #6ee7b7; padding: 8px 16px; border-radius: var(--radius-pill); font-weight: 700; display: inline-flex; align-items: center; gap: 8px; font-size: 1.1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);}

        /* ========= CARDS & CONTENT ========= */
        .card-glass {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-sm);
            padding: 30px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .section-title { font-size: 1.3rem; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; }
        .title-icon { width: 40px; height: 40px; border-radius: 12px; background: var(--color-primary-light); color: var(--color-primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;}

        .info-group { margin-bottom: 20px; }
        .info-label { display: block; font-size: 0.85rem; color: var(--color-text-light); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 6px; }
        .info-value { font-size: 1.05rem; color: var(--color-text); font-weight: 600; padding: 12px 16px; background: var(--color-bg); border-radius: 10px; border: 1px solid var(--color-border); }

        .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: var(--radius-pill); font-weight: 700; font-size: 0.9rem;}
        .status-active { background: #dcfce7; color: #166534; }
        .status-inactive { background: #fee2e2; color: #991b1b; }

        /* ========= BUTTONS ========= */
        .btn-custom {
            background: var(--color-primary); color: white; border: none; padding: 12px 24px; border-radius: var(--radius-pill);
            font-weight: 600; font-size: 0.95rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: inline-flex; justify-content: center; align-items: center; gap: 8px;
        }
        .btn-custom:hover { background: var(--color-primary-dark); color: white; transform: translateY(-2px); box-shadow: 0 8px 15px rgba(16, 185, 129, 0.25); }
        
        .btn-outline-custom { background: white; color: var(--color-text); border: 1px solid var(--color-border); padding: 12px 24px; border-radius: var(--radius-pill); font-weight: 600; transition: all 0.2s; display: inline-flex; justify-content: center; align-items: center; gap: 8px;}
        .btn-outline-custom:hover { background: #f1f5f9; color: var(--color-secondary); border-color: #cbd5e1; transform: translateY(-2px);}

        .btn-dark-custom { background: var(--color-secondary); color: white; border: none; padding: 12px 24px; border-radius: var(--radius-pill); font-weight: 600; transition: all 0.2s; display: inline-flex; justify-content: center; align-items: center; gap: 8px;}
        .btn-dark-custom:hover { background: #1e293b; color: white; transform: translateY(-2px); box-shadow: 0 8px 15px rgba(0,0,0,0.2);}

        .action-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 10px;}
        .action-card-link { text-decoration: none; color: inherit;}
        .action-card { border: 1px solid var(--color-border); border-radius: 16px; padding: 20px; text-align: center; transition: all 0.3s; background: white; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 10px;}
        .action-card:hover { border-color: var(--color-primary); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.1); transform: translateY(-5px); color: var(--color-primary);}
        .action-card i { font-size: 2.5rem; color: var(--color-primary-light); transition: all 0.3s; }
        .action-card:hover i { color: var(--color-primary); }
        .action-card h6 { margin: 0; font-size: 1rem; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; color: var(--color-secondary);}

        /* ========= MODALS ========= */
        .modal-content { border-radius: var(--radius-lg); border: none; box-shadow: var(--shadow-lg); }
        .modal-header { border-bottom: 1px solid var(--color-border); padding: 24px 30px; background: white; border-radius: var(--radius-lg) var(--radius-lg) 0 0;}
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); }
        .modal-body { padding: 30px; background: var(--color-bg);}
        .modal-footer { border-top: 1px solid var(--color-border); padding: 20px 30px; background: white; border-radius: 0 0 var(--radius-lg) var(--radius-lg);}
        
        .form-label { font-weight: 600; color: var(--color-text); margin-bottom: 8px; font-size: 0.95rem;}
        .form-control { border-radius: 12px; padding: 12px 16px; border: 1px solid var(--color-border); transition: all 0.3s; font-size: 0.95rem; background: white;}
        .form-control:focus { border-color: var(--color-primary); box-shadow: 0 0 0 4px var(--color-primary-light); background: white;}

        /* Alert styling */
        .alert-custom { border-radius: 12px; border: none; padding: 15px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; margin-bottom: 25px;}
        .alert-success-custom { background: #dcfce7; color: #166534; }
        .alert-error-custom { background: #fee2e2; color: #991b1b; }

        /* Footer */
        .custom-footer { background: white; border-top: 1px solid var(--color-border); padding: 24px 0; margin-top: auto; }
        
        @media (max-width: 768px) {
            .profile-header { padding: 30px 20px; justify-content: center; text-align: center; }
            .profile-user-info { flex-direction: column; }
            .point-badge { margin-top: 10px; }
            .card-glass { padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-glass fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo">
                ReUse<span>Mart</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="bi bi-house-door me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('keranjang') }}"><i class="bi bi-cart3 me-1"></i> Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('pembeli.profil') }}"><i class="bi bi-person-circle me-1"></i> Profil Saya</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-3 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                            @csrf
                            <button class="btn-logout w-100" type="submit"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5 mt-3 flex-grow-1">
        
        @if ($errors->any())
            <div class="alert alert-custom alert-error-custom alert-dismissible fade show shadow-sm">
                <i class="bi bi-exclamation-triangle-fill fs-5 mt-1 align-self-start"></i>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close align-self-start mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-custom alert-success-custom alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill fs-5"></i> 
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- HEADER PROFILE -->
        <div class="profile-header">
            <div class="profile-user-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($pembeli->nama_pembeli) }}&background=ffffff&color=0f172a&size=128" alt="User" class="profile-avatar">
                <div class="profile-details">
                    <h2>{{ $pembeli->nama_pembeli }}</h2>
                    <p><i class="bi bi-envelope-fill"></i> {{ $pembeli->email }}</p>
                </div>
            </div>
            <div class="point-badge" title="Poin ReUseMart Anda">
                <i class="bi bi-stars"></i> {{ number_format($pembeli->poin, 0, ',', '.') }} Poin
            </div>
        </div>

        <div class="row g-4">
            <!-- INFO AKUN -->
            <div class="col-lg-6">
                <div class="card-glass h-100">
                    <div class="section-title">
                        <div class="title-icon"><i class="bi bi-person-badge"></i></div>
                        <h3 class="m-0 fs-4 text-dark font-outfit">Informasi Akun</h3>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-sm-6">
                            <div class="info-group">
                                <span class="info-label">Nama Lengkap</span>
                                <div class="info-value">{{ $pembeli->nama_pembeli }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-group">
                                <span class="info-label">Username Login</span>
                                <div class="info-value">{{ $pembeli->username }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-group">
                                <span class="info-label">Nomor Telepon</span>
                                <div class="info-value"><i class="bi bi-telephone text-muted me-2"></i>{{ $pembeli->notelp }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-group">
                                <span class="info-label">Status Akun</span>
                                <div class="mt-1">
                                    @if ($pembeli->status_aktif)
                                        <span class="status-badge status-active"><i class="bi bi-shield-check"></i> Akun Aktif</span>
                                    @else
                                        <span class="status-badge status-inactive"><i class="bi bi-shield-lock"></i> Tidak Aktif</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                        <button type="button" class="btn-custom flex-grow-1" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </button>
                        
                        <form action="{{ route('pembeli.toggleStatus', $pembeli->id_pembeli) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Yakin ingin mengubah status keamanan akun ini?')">
                            @csrf
                            @method('PUT')
                            @if ($pembeli->status_aktif)
                                <button type="submit" class="btn-dark-custom w-100"><i class="bi bi-lock-fill"></i> Nonaktifkan Akun</button>
                            @else
                                <button type="submit" class="btn-outline-custom w-100" style="border-color: var(--color-primary); color: var(--color-primary);"><i class="bi bi-unlock-fill"></i> Aktifkan Akun</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- MENU TINDAKAN -->
            <div class="col-lg-6">
                <div class="card-glass h-100">
                    <div class="section-title">
                        <div class="title-icon" style="background: #eef2ff; color: #6366f1;"><i class="bi bi-grid"></i></div>
                        <h3 class="m-0 fs-4 text-dark font-outfit">Menu Pembeli</h3>
                    </div>
                    <p class="text-muted mb-4">Kelola transaksi, keranjang belanja, dan alamat pengiriman Anda dengan mudah.</p>

                    <div class="action-cards">
                        <a href="{{ route('pembeli.riwayatTransaksi') }}" class="action-card-link">
                            <div class="action-card">
                                <i class="bi bi-receipt"></i>
                                <h6>Riwayat Pembelian</h6>
                            </div>
                        </a>
                        
                        <a href="{{ route('alamatPembeli.index') }}" class="action-card-link">
                            <div class="action-card">
                                <i class="bi bi-geo-alt"></i>
                                <h6>Buku Alamat</h6>
                            </div>
                        </a>

                        <a href="{{ route('keranjang') }}" class="action-card-link">
                            <div class="action-card">
                                <i class="bi bi-cart"></i>
                                <h6>Keranjang Saya</h6>
                            </div>
                        </a>
                        
                        <a href="{{ url('/') }}" class="action-card-link">
                            <div class="action-card">
                                <i class="bi bi-shop"></i>
                                <h6>Belanja Lagi</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PROFIL -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form action="{{ route('pembeli.update', $pembeli->id_pembeli) }}" method="POST" class="modal-content" onsubmit="return confirm('Simpan perubahan profil Anda?')">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Profil Pembeli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 bg-white p-4 rounded-3 border">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_pembeli" class="form-control" value="{{ $pembeli->nama_pembeli }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username Valid</label>
                        <input type="text" name="username" class="form-control" value="{{ $pembeli->username }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="notelp" class="form-control" value="{{ $pembeli->notelp }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat Email Aktif</label>
                        <input type="email" name="email" class="form-control" value="{{ $pembeli->email }}" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn-custom m-0"><i class="bi bi-save"></i> Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="custom-footer text-center">
        <div class="container">
            <p class="text-muted mb-0 fw-medium" style="font-size: 0.9rem;">&copy; {{ date('Y') }} ReUseMart. Platform E-Commerce Barang Bekas Berkualitas.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
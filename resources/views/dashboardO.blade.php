<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Organisasi - ReUseMart</title>

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
            --shadow-float: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.6;
            padding-top: 80px; /* For sticky nav */
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

        /* ========= HEADER & STATS ========= */
        .dashboard-header {
            background: linear-gradient(135deg, var(--color-secondary) 0%, #1e293b 100%);
            border-radius: var(--radius-lg);
            padding: 40px;
            color: white;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }
        .dashboard-header::after {
            content: ''; position: absolute; top: -50%; right: -10%; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%); border-radius: 50%;
        }
        
        .user-greeting { position: relative; z-index: 1;}
        .user-greeting h2 { color: white; margin-bottom: 5px; font-size: 2rem;}
        .user-greeting p { color: #94a3b8; margin: 0; font-size: 1.1rem;}

        /* ========= MAIN CONTENT ========= */
        .card-glass {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-sm);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .section-title { font-size: 1.4rem; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; }
        .section-title div { display: flex; align-items: center; gap: 10px; }
        .title-icon { width: 40px; height: 40px; border-radius: 12px; background: var(--color-primary-light); color: var(--color-primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;}

        .btn-custom {
            background: var(--color-primary); color: white; border: none; padding: 10px 24px; border-radius: var(--radius-pill);
            font-weight: 600; font-size: 0.95rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: inline-flex; justify-content: center; align-items: center; gap: 8px;
        }
        .btn-custom:hover { background: var(--color-primary-dark); color: white; transform: translateY(-2px); box-shadow: 0 8px 15px rgba(16, 185, 129, 0.25); }

        .search-box { position: relative; width: 300px; max-width: 100%;}
        .search-box input { width: 100%; padding: 12px 20px 12px 45px; border-radius: var(--radius-pill); border: 1px solid var(--color-border); background: var(--color-bg); font-size: 0.95rem; transition: all 0.3s;}
        .search-box input:focus { border-color: var(--color-primary); background: white; outline: none; box-shadow: 0 0 0 4px var(--color-primary-light);}
        .search-box i { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--color-text-light); }

        /* ========= TABLES ========= */
        .table-responsive { border-radius: 16px; overflow: hidden; border: 1px solid var(--color-border); }
        .table { margin-bottom: 0; }
        .table th { background: #f8fafc; color: var(--color-text-light); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; padding: 16px 20px; border-bottom: 1px solid var(--color-border); white-space: nowrap;}
        .table td { padding: 16px 20px; vertical-align: middle; border-bottom: 1px solid var(--color-border); color: var(--color-text); font-size: 0.95rem;}
        .table tbody tr:last-child td { border-bottom: none; }
        .table tbody tr:hover { background: #f1f5f9; }

        .badge-status { padding: 6px 14px; border-radius: var(--radius-pill); font-weight: 600; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 5px; }
        .status-diterima { background: #dcfce7; color: #166534; }
        .status-menunggu { background: #fef3c7; color: #b45309; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }

        .btn-action { width: 36px; height: 36px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem; transition: all 0.2s; border: none;}
        .btn-edit { background: #fffbeb; color: #d97706; }
        .btn-edit:hover { background: #f59e0b; color: white; }
        .btn-delete { background: #fef2f2; color: #ef4444; }
        .btn-delete:hover { background: #ef4444; color: white; }

        .action-group { display: flex; gap: 8px; flex-wrap: nowrap;}

        /* Pagination */
        .pagination { margin: 0; }
        .page-link { border: none; color: var(--color-text); font-weight: 600; margin: 0 4px; border-radius: 8px !important; transition: all 0.2s;}
        .page-item.active .page-link { background: var(--color-primary); color: white; }
        .page-link:hover:not(.active) { background: var(--color-primary-light); color: var(--color-primary); }

        /* ========= MODALS ========= */
        .modal-content { border-radius: var(--radius-lg); border: none; box-shadow: var(--shadow-float); }
        .modal-header { border-bottom: 1px solid var(--color-border); padding: 24px 30px; background: white; border-radius: var(--radius-lg) var(--radius-lg) 0 0;}
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); }
        .modal-body { padding: 30px; background: var(--color-bg);}
        .modal-footer { border-top: 1px solid var(--color-border); padding: 20px 30px; background: white; border-radius: 0 0 var(--radius-lg) var(--radius-lg);}
        
        .form-label { font-weight: 600; color: var(--color-text); margin-bottom: 8px; font-size: 0.95rem;}
        .form-control { border-radius: 12px; padding: 12px 16px; border: 1px solid var(--color-border); transition: all 0.3s; font-size: 0.95rem; background: white;}
        .form-control:focus { border-color: var(--color-primary); box-shadow: 0 0 0 4px var(--color-primary-light); background: white;}

        .btn-outline-custom { background: white; color: var(--color-text); border: 1px solid var(--color-border); padding: 10px 24px; border-radius: var(--radius-pill); font-weight: 600; transition: all 0.2s;}
        .btn-outline-custom:hover { background: #f1f5f9; color: var(--color-secondary); border-color: #cbd5e1;}

        /* Alert styling */
        .alert-custom { border-radius: 12px; border: none; padding: 15px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; margin-bottom: 25px;}
        .alert-success-custom { background: #dcfce7; color: #166534; }
        .alert-error-custom { background: #fee2e2; color: #991b1b; }

        /* Footer */
        .custom-footer { background: white; border-top: 1px solid var(--color-border); padding: 24px 0; margin-top: auto; }
        
        @media (max-width: 768px) {
            .dashboard-header { padding: 30px 20px; }
            .card-glass { padding: 20px; }
            .section-title { flex-direction: column; align-items: flex-start; gap: 15px;}
            .search-box { width: 100%; }
            .section-title .d-flex { width: 100%; justify-content: space-between;}
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
                        <a class="nav-link active" href="#"><i class="bi bi-grid me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-person me-1"></i> Profil LKS</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-3 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn-logout w-100" type="submit"><i class="bi bi-box-arrow-right me-1"></i> Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5 mt-4 flex-grow-1">
        
        @if(session('success'))
            <div class="alert alert-custom alert-success-custom alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill fs-5"></i> 
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-custom alert-error-custom alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill fs-5 mt-1 align-self-start"></i>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close align-self-start mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- HEADER -->
        <header class="dashboard-header">
            <div class="user-greeting">
                <h2>Selamat Datang, {{ Auth::user()->nama_organisasi }}!</h2>
                <p>Kelola permintaan donasi untuk organisasi Anda dari dashboard ini.</p>
            </div>
        </header>

        <!-- MAIN CARD -->
        <div class="card-glass">
            <div class="section-title">
                <div>
                    <div class="title-icon"><i class="bi bi-box2-heart"></i></div>
                    <h3 class="m-0 fs-4 text-dark font-outfit">Daftar Request Donasi</h3>
                </div>
                
                <div class="d-flex align-items-center gap-3 flex-wrap flex-md-nowrap">
                    <form action="{{ route('organisasi.request.index') }}" method="GET" class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" name="q" placeholder="Cari nama barang..." value="{{ $search ?? '' }}">
                    </form>
                    <button class="btn-custom" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-lg"></i> Tambah Request
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th>Barang Dibutuhkan</th>
                            <th>Organisasi</th>
                            <th>Status Request</th>
                            <th class="text-end" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requestDonasis as $index => $requestDonasi)
                            <tr>
                                <td class="text-muted fw-bold">#{{ $requestDonasis->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $requestDonasi->barang_dibutuhkan }}</div>
                                </td>
                                <td>{{ $requestDonasi->organisasi->nama_organisasi }}</td>
                                <td>
                                    @php
                                        $statusClass = 'status-menunggu';
                                        $icon = 'bi-clock-history';
                                        if($requestDonasi->status_request == 'Diterima') {
                                            $statusClass = 'status-diterima';
                                            $icon = 'bi-check-circle-fill';
                                        } elseif($requestDonasi->status_request == 'Ditolak') {
                                            $statusClass = 'status-ditolak';
                                            $icon = 'bi-x-circle-fill';
                                        }
                                    @endphp
                                    <span class="badge-status {{ $statusClass }}">
                                        <i class="bi {{ $icon }}"></i> {{ $requestDonasi->status_request }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-group justify-content-end">
                                        <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $requestDonasi->id_request }}" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('organisasi.request.destroy', $requestDonasi->id_request) }}" method="POST" onsubmit="return confirm('PERINGATAN: Yakin ingin menghapus request donasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $requestDonasi->id_request }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('organisasi.request.update', $requestDonasi->id_request) }}" method="POST" onsubmit="return confirm('Simpan perubahan pada request ini?')">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Request Donasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Barang Dibutuhkan</label>
                                                    <input type="text" name="barang_dibutuhkan" class="form-control" value="{{ $requestDonasi->barang_dibutuhkan }}" required placeholder="Contoh: Pakaian Layak Pakai, Buku Tulis">
                                                    <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>Spesifikasikan barang yang Anda butuhkan secara jelas.</div>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label text-muted d-block">Status Saat Ini</label>
                                                    <span class="badge-status {{ $statusClass }}">
                                                        <i class="bi {{ $icon }}"></i> {{ $requestDonasi->status_request }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn-custom m-0">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                        <h5 class="font-outfit text-dark fw-bold">Belum Ada Request</h5>
                                        <p>Anda belum membuat request donasi barang apapun.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($requestDonasis->hasPages())
            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                {{ $requestDonasis->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
            @endif

        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('organisasi.request.store') }}" method="POST" onsubmit="return confirm('Yakin ingin mengajukan request donasi ini?')">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-plus-circle-fill me-2 text-primary"></i>Ajukan Request Donasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-custom alert-success-custom mb-4 py-2">
                                <i class="bi bi-info-circle-fill"></i> Sampaikan kebutuhan panti sosial/organisasi Anda.
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Barang Dibutuhkan</label>
                                <input type="text" name="barang_dibutuhkan" class="form-control" required placeholder="Contoh: Pakaian Layak Pakai, Buku Tulis, Mainan Anak">
                                <div class="form-text mt-2"><i class="bi bi-lightning-fill text-warning me-1"></i>Usahakan spesifik agar donatur mudah memahami.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-custom m-0"><i class="bi bi-send-fill me-1"></i> Ajukan Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="custom-footer text-center">
        <div class="container">
            <p class="text-muted mb-0 fw-medium" style="font-size: 0.9rem;">&copy; {{ date('Y') }} ReUseMart. Platform Donasi & Penitipan Barang Terbaik.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

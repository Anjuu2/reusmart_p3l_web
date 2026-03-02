<!-- ReUseMart - Dashboard Penitip -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penitip | ReUseMart</title>
    
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

        .user-profile-btn:hover, .user-profile-btn:focus {
            background: #f1f5f9;
            color: var(--color-primary-dark);
        }

        .user-profile-btn img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        /* Main Content Container */
        .main-container {
            flex: 1;
            padding: 40px 0;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }
        .page-title span { color: var(--color-primary); }

        /* Search Bar */
        .search-container {
            background: var(--color-surface);
            border-radius: var(--radius-pill);
            padding: 5px;
            display: flex;
            border: 1px solid var(--color-border);
            transition: all 0.3s ease;
            max-width: 400px;
            margin-left: auto;
        }

        .search-container:focus-within {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .search-input {
            border: none;
            background: transparent;
            padding: 10px 20px;
            box-shadow: none !important;
            flex: 1;
        }

        .search-btn {
            background: var(--color-primary);
            color: white;
            border: none;
            border-radius: var(--radius-pill);
            padding: 10px 25px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: var(--color-primary-dark);
        }

        /* Card and Table styling */
        .content-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-sm);
            padding: 25px;
            overflow: hidden;
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table-custom thead th {
            border: none;
            color: var(--color-text-light);
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 10px 20px;
            background: transparent;
        }

        .table-custom tbody tr {
            background: var(--color-surface);
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            border-radius: 12px;
            border: 1px solid var(--color-border);
        }

        .table-custom tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
            position: relative;
            z-index: 10;
        }

        .table-custom td {
            border: none;
            padding: 16px 20px;
            vertical-align: middle;
            color: var(--color-text-main);
            border-top: 1px solid var(--color-border);
            border-bottom: 1px solid var(--color-border);
        }

        .table-custom tbody tr td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            border-left: 1px solid var(--color-border);
            font-weight: 600;
            color: var(--color-secondary);
        }

        .table-custom tbody tr td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
            border-right: 1px solid var(--color-border);
        }

        /* Status Badges */
        .status-badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-tersedia { background: #e0f2fe; color: #0284c7; }
        .status-terjual { background: #dcfce7; color: #166534; }
        .status-didonasikan { background: #fef9c3; color: #854d0e; }
        .status-donasi { background: #f1f5f9; color: #475569; }
        .status-diambil { background: #fee2e2; color: #991b1b; }

        .time-badge {
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Action Buttons */
        .btn-action {
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-outline-primary {
            color: var(--color-primary);
            border-color: var(--color-primary);
        }
        .btn-outline-primary:hover {
            background: var(--color-primary);
            border-color: var(--color-primary);
        }

        .item-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--color-border);
            background: #f1f5f9;
            transition: transform 0.3s;
            cursor: pointer;
        }

        .item-thumbnail:hover {
            transform: scale(1.1) rotate(2deg);
        }

        /* Pagination */
        .pagination { justify-content: flex-end; margin-top: 25px; }
        .page-link {
            border: none;
            color: var(--color-text-main);
            border-radius: 8px !important;
            margin: 0 3px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .page-item.active .page-link { background-color: var(--color-primary); color: white; }
        .page-link:hover:not(.active) { background-color: #f1f5f9; color: var(--color-primary); transform: translateY(-2px); }

        /* Custom Footer (Simplified Unified Version) */
        .footer {
            background: var(--color-surface);
            border-top: 1px solid var(--color-border);
            padding: 40px 0 20px;
            margin-top: auto;
        }
        
        .footer-brand .brand-logo { width: 36px; height: 36px; }
        .footer-text { color: var(--color-text-light); font-size: 0.95rem; line-height: 1.6; }
        .social-links { display: flex; gap: 12px; margin-top: 20px; }
        .social-link {
            width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; display: flex;
            align-items: center; justify-content: center; color: var(--color-text-main); font-size: 1.1rem;
            transition: all 0.3s;
        }
        .social-link:hover { background: var(--color-primary); color: white; transform: translateY(-3px); }
        .footer-bottom { border-top: 1px solid var(--color-border); margin-top: 30px; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;}
        .footer-bottom p { margin: 0; color: var(--color-text-light); font-size: 0.9rem; }

        /* Alert */
        .alert-custom {
            border-radius: 12px;
            border: none;
            border-left: 4px solid var(--color-primary);
            background: #ecfdf5;
            color: #065f46;
            font-weight: 600;
        }
        
        /* Modals */
        .modal-content { border-radius: var(--radius-lg); border: none; box-shadow: var(--shadow-lg); }
        .modal-header { background: var(--color-bg); border-bottom: 1px solid var(--color-border); padding: 20px 25px; }
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); }
        .modal-body { padding: 25px; font-size: 0.95rem; line-height: 1.6; }
        .modal-body p { margin-bottom: 12px; }
        .modal-body strong { color: var(--color-secondary); display: inline-block; width: 100px; }
        
        @media (max-width: 768px) {
            .search-container { margin-left: 0; max-width: 100%; margin-top: 15px; }
        }
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
                    <a class="dropdown-item py-2 fw-semibold" href="{{ route('penitip.profil') }}">
                        <i class="bi bi-person-circle me-2 text-muted"></i> Profil Saya
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

<!-- Main Content -->
<div class="main-container">
    <div class="container">
        
        @if(session('success'))
            <div class="alert alert-custom alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2 bg-success text-white rounded-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row align-items-center mb-4 page-header">
            <div class="col-md-6 mb-3 mb-md-0">
                <h2 class="page-title m-0">Dashboard <span>Penitip</span></h2>
                <p class="text-muted mt-2 mb-0">Kelola dan pantau barang yang Anda titipkan di ReUseMart.</p>
            </div>
            <div class="col-md-6">
                <form action="{{ route('penitip.barang.index') }}" method="GET" class="search-container">
                    <i class="bi bi-search text-muted ms-3 d-flex align-items-center"></i>
                    <input type="text" name="q" class="form-control search-input" placeholder="Cari nama barang..." value="{{ request('q') }}">
                    <button class="search-btn" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <div class="content-card">
            <div class="table-responsive" style="min-height: 300px;">
                <table class="table table-custom table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama Barang</th>
                            <th>Status</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Keluar</th>
                            <th>Sisa Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $index => $barang)
                            <tr>
                                <td>#{{ $barang->id_barang }}</td>
                                <td>
                                    <img src="{{ asset('images/barang/' . ($barang->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" 
                                         alt="{{ $barang->nama_barang }}" 
                                         class="item-thumbnail" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#modalDeskripsi{{ $barang->id_barang }}">
                                </td>
                                <td>
                                    <span class="fw-bold d-block" style="color: var(--color-secondary);">{{ Str::limit($barang->nama_barang, 25) }}</span>
                                    <span class="text-muted fs-6">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    @php
                                        $status = strtolower($barang->status_barang);
                                    @endphp
                                    <span class="status-badge
                                        {{ $status === 'tersedia' ? 'status-tersedia' : '' }}
                                        {{ $status === 'terjual' ? 'status-terjual' : '' }}
                                        {{ $status === 'didonasikan' ? 'status-didonasikan' : '' }}
                                        {{ $status === 'barang untuk donasi' ? 'status-donasi' : '' }}
                                        {{ in_array($status, ['diambil kembali', 'pengambilan diproses']) ? 'status-diambil' : '' }}">
                                        
                                        @if($status === 'tersedia') <i class="bi bi-check-circle"></i>
                                        @elseif($status === 'terjual') <i class="bi bi-bag-check"></i>
                                        @elseif($status === 'didonasikan') <i class="bi bi-heart"></i>
                                        @elseif(in_array($status, ['diambil kembali', 'pengambilan diproses'])) <i class="bi bi-arrow-return-left"></i>
                                        @endif
                                        
                                        {{ $status === 'barang untuk donasi' ? 'Tunggu Donasi' : ucfirst($barang->status_barang) }}
                                    </span>
                                </td>
                                <td><i class="bi bi-calendar-event text-muted me-1"></i> {{ \Carbon\Carbon::parse($barang->tanggal_masuk)->locale('id')->isoFormat('D MMM YY') }}</td>
                                <td>
                                    {{ $barang->tanggal_keluar 
                                        ? \Carbon\Carbon::parse($barang->tanggal_keluar)->locale('id')->isoFormat('D MMM YY') 
                                        : '-' 
                                    }}
                                </td>
                                <td>
                                    @if($barang->status_barang === 'Tersedia')
                                        @php
                                            $tanggalAkhir = \Carbon\Carbon::parse($barang->tanggal_akhir);
                                            $hariSekarang = now();
                                            $sisaHari = round($hariSekarang->diffInDays($tanggalAkhir, false));
                                            $hariLewat = round($hariSekarang->diffInDays($tanggalAkhir, false) * -1);
                                            $batasAmbil = 7; 
                                        @endphp
                                        @if($sisaHari > 0)
                                            <span class="time-badge bg-success bg-opacity-10 text-success"><i class="bi bi-clock me-1"></i> {{ $sisaHari }} hari</span>
                                        @elseif($sisaHari === 0)
                                            <span class="time-badge bg-warning bg-opacity-25 text-warning-emphasis"><i class="bi bi-exclamation-triangle me-1"></i> Terakhir!</span>
                                        @elseif($hariLewat <= $batasAmbil)
                                            <span class="time-badge bg-danger bg-opacity-10 text-danger"><i class="bi bi-alarm me-1"></i> Lwt {{ $hariLewat }} hari</span>
                                        @else
                                            <span class="time-badge bg-danger text-white"><i class="bi bi-x-circle me-1"></i> Telat {{ $hariLewat }} hd</span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($barang->status_barang === 'Tersedia')
                                        @if(!$barang->status_perpanjangan && $hariSekarang->isAfter($tanggalAkhir) || ($batasAmbil - $hariLewat == 7))
                                            <form action="{{ route('penitip.perpanjang', $barang->id_barang) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-action btn-outline-primary" title="Perpanjang Penitipan"><i class="bi bi-arrow-clockwise"></i></button>
                                            </form>
                                        @endif

                                        @if($hariLewat >= 0 && $hariLewat <= $batasAmbil)
                                            <form action="{{ route('penitip.ambil', $barang->id_barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Ambil barang ini sekarang?')">
                                                @csrf
                                                <button class="btn btn-action btn-outline-danger" title="Ambil Kembali"><i class="bi bi-box-seam"></i></button>
                                            </form>
                                        @endif
                                    @elseif($barang->status_barang === 'Terjual')
                                        <button class="btn btn-action btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $barang->id_barang }}" title="Lihat Detail"><i class="bi bi-info-circle"></i></button>
                                    @endif
                                </td>                               
                            </tr>

                            <!-- Modal Deskripsi -->
                            <div class="modal fade" id="modalDeskripsi{{ $barang->id_barang }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-box-seam text-primary me-2"></i> Detail Barang</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center mb-4 p-3 bg-light rounded-3 border">
                                                <img src="{{ asset('images/barang/' . ($barang->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" class="img-fluid rounded-3" style="max-height: 250px; object-fit: contain;">
                                            </div>
                                            <p><strong>Nama</strong> <span class="text-muted text-end ms-2 me-2">:</span> <span class="fw-bold">{{ $barang->nama_barang }}</span></p>
                                            <p><strong>Harga Jual</strong> <span class="text-muted text-end ms-2 me-2">:</span> <span class="fw-bold text-success">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</span></p>
                                            <p class="mb-2"><strong>Deskripsi</strong> <span class="text-muted text-end ms-2 me-2">:</span></p>
                                            <div class="p-3 bg-light rounded-3 text-muted border" style="font-size: 0.9rem;">
                                                {{ $barang->deskripsi }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Detail / Resi / Bukti Penjualan -->
                            <div class="modal fade" id="modalDetail{{ $barang->id_barang }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-receipt text-success me-2"></i> Detail Penjualan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-success d-flex align-items-center mb-4">
                                                <i class="bi bi-check-circle-fill me-2 fs-4"></i> 
                                                <span>Barang ini telah berhasil terjual. Dana penitipan dapat dicairkan sesuai S&K.</span>
                                            </div>
                                            <p><strong>Nama</strong> <span class="text-muted text-end ms-2 me-2">:</span> <span class="fw-bold">{{ $barang->nama_barang }}</span></p>
                                            <p><strong>Harga Jual</strong> <span class="text-muted text-end ms-2 me-2">:</span> <span class="fw-bold text-success fs-5">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center" style="padding: 60px 20px;">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox" style="font-size: 4rem; color: #cbd5e1;"></i>
                                        <h5 class="mt-3 text-dark fw-bold" style="font-family: 'Outfit', sans-serif;">Belum ada barang titipan</h5>
                                        <p>Barang yang Anda titipkan akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {!! $barangs->withQueryString()->links('pagination::bootstrap-5') !!}
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Dashboard | ReUseMart</title>

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
            --admin-primary: #0f172a;      
            --admin-secondary: #1e293b;    
            --admin-accent: #10b981;       /* Changed to ReUseMart Green for CS */
            --admin-accent-dark: #059669;
            --admin-success: #10b981;
            --admin-warning: #f59e0b;
            --admin-danger: #ef4444;
            --admin-bg: #f8fafc;
            --admin-surface: #ffffff;
            --admin-text-main: #334155;
            --admin-text-light: #64748b;
            --admin-border: #e2e8f0;
            --sidebar-width: 260px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text-main);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--admin-primary); }

        /* ====== SIDEBAR ====== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--admin-primary);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            gap: 12px;
            text-decoration: none;
            color: white;
        }
        .sidebar-brand img { width: 32px; height: 32px; border-radius: 8px; }
        .sidebar-brand span { font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 700; letter-spacing: 0.5px;}
        .sidebar-brand span span { color: var(--admin-accent); }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 20px 16px;
            list-style: none;
            margin: 0;
        }
        
        .menu-label {
            font-size: 0.75rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin: 15px 0 10px 12px;
        }

        .menu-item { margin-bottom: 4px; }
        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.95rem;
            gap: 12px;
        }
        .menu-link i { font-size: 1.1rem; width: 20px; text-align: center; }
        .menu-link:hover { background: rgba(255,255,255,0.1); color: white; }
        .menu-item.active .menu-link { background: var(--admin-accent); color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: var(--admin-secondary);
        }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 10px; background: #cbd5e1; }
        .user-details h6 { margin: 0; color: white; font-size: 0.95rem; font-family: 'Plus Jakarta Sans', sans-serif;}
        .user-details span { font-size: 0.8rem; color: #94a3b8; }

        /* ====== MAIN WRAPPER ====== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* ====== TOP NAVBAR ====== */
        .top-navbar {
            height: 70px;
            background: var(--admin-surface);
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .nav-widgets { display: flex; align-items: center; gap: 20px; margin-left: auto;}
        .widget-btn {
            position: relative; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: var(--admin-text-main); font-size: 1.1rem; background: var(--admin-bg); cursor: pointer; transition: all 0.2s; border: none;
        }
        .widget-btn:hover { background: #e2e8f0; color: var(--admin-primary); }

        /* ====== CONTENT AREA ====== */
        .content-area {
            padding: 30px;
            flex: 1;
        }

        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;}
        .page-title { margin: 0; font-size: 1.6rem; }
        .breadcrumb { display: flex; gap: 8px; font-size: 0.85rem; color: var(--admin-text-light); margin: 0; list-style: none; padding: 0;}
        .breadcrumb-item.active { color: var(--admin-primary); font-weight: 600; }
        .breadcrumb-item + .breadcrumb-item::before { content: "/"; margin-right: 8px; color: #cbd5e1; }

        .btn-custom { background: var(--admin-accent); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;}
        .btn-custom:hover { background: var(--admin-accent-dark); color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2); }

        /* Dashboard Card & Table */
        .dashboard-card { background: var(--admin-surface); border-radius: var(--radius-lg); border: 1px solid var(--admin-border); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 24px;}
        .card-header-styled { padding: 20px 24px; border-bottom: 1px solid var(--admin-border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; background: transparent;}
        
        .search-box { position: relative; width: 300px; max-width: 100%;}
        .search-box input { width: 100%; padding: 10px 15px 10px 40px; border-radius: 8px; border: 1px solid var(--admin-border); background: var(--admin-bg); font-size: 0.9rem; transition: all 0.2s; }
        .search-box input:focus { border-color: var(--admin-accent); outline: none; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); background: white;}
        .search-box i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--admin-text-light); }

        .table-responsive { overflow-x: auto; }
        .table-modern { width: 100%; border-collapse: separate; border-spacing: 0; margin: 0;}
        .table-modern th { background: #f8fafc; color: var(--admin-text-light); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; padding: 14px 20px; border-bottom: 1px solid var(--admin-border); white-space: nowrap;}
        .table-modern td { padding: 16px 20px; border-bottom: 1px solid var(--admin-border); vertical-align: middle; font-size: 0.95rem; color: var(--admin-text-main);}
        .table-modern tbody tr:last-child td { border-bottom: none; }
        .table-modern tbody tr:hover { background: #f8fafc; }

        .ktp-link { color: var(--admin-accent); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #ecfdf5; border-radius: 6px; font-size: 0.85rem;}
        .ktp-link:hover { background: var(--admin-accent); color: white; }

        .status-badge { padding: 6px 12px; border-radius: 30px; font-size: 0.8rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;}
        .status-active { background: #dcfce7; color: #166534; }
        .status-inactive { background: #f1f5f9; color: #475569; }

        .action-cell { display: flex; gap: 8px; flex-wrap: nowrap; }
        .btn-action-icon { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; border: none; font-size: 0.9rem;}
        .btn-edit { background: #fffbeb; color: #d97706; }
        .btn-edit:hover { background: #f59e0b; color: white; }
        .btn-delete { background: #fef2f2; color: #ef4444; }
        .btn-delete:hover { background: #ef4444; color: white; }

        /* Pagination */
        .pagination { justify-content: flex-end; margin: 20px 24px 20px 0; }
        .page-link { border: none; color: var(--admin-text-main); border-radius: 8px !important; margin: 0 3px; padding: 8px 16px; font-weight: 600; transition: all 0.2s; }
        .page-item.active .page-link { background-color: var(--admin-accent); color: white; }
        .page-link:hover:not(.active) { background-color: #f1f5f9; color: var(--admin-accent); transform: translateY(-2px); }

        /* MODALS */
        .modal-content { border-radius: var(--radius-lg); border: none; box-shadow: var(--shadow-lg); overflow: hidden;}
        .modal-header { background: var(--admin-surface); border-bottom: 1px solid var(--admin-border); padding: 20px 25px; }
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--admin-primary); }
        .modal-body { padding: 25px; background: #f8fafc;}
        .form-label { font-weight: 600; color: var(--admin-text-main); font-size: 0.9rem; margin-bottom: 6px; }
        .form-control { border-radius: 8px; border: 1px solid var(--admin-border); padding: 10px 15px; font-size: 0.95rem; transition: all 0.2s;}
        .form-control:focus { border-color: var(--admin-accent); box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }
        .modal-footer { padding: 20px 25px; border-top: 1px solid var(--admin-border); background: var(--admin-surface); }

        .alert-custom { border-radius: 12px; border: none; border-left: 4px solid var(--admin-success); background: #ecfdf5; color: #065f46; font-weight: 600; }
        .alert-error { border-left-color: var(--admin-danger); background: #fef2f2; color: #991b1b; }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .sidebar-open .sidebar { transform: translateX(0); }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="{{ url('/') }}" class="sidebar-brand">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo">
            <span>ReUse<span>Mart</span></span>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-label">Menu CS</li>
            <li class="menu-item active">
                <a href="{{ route('cs.penitip.index') }}" class="menu-link"><i class="bi bi-people-fill"></i> Data Penitip</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-headset"></i> Pesan & Tiket</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-shield-check"></i> Verifikasi Akun</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_pegawai ?? 'CS') }}&background=10b981&color=fff" alt="User" class="user-avatar">
                <div class="user-details">
                    <h6>{{ Auth::user()->nama_pegawai ?? 'Customer Service' }}</h6>
                    <span>Divisi CS</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-sm w-100" style="background: rgba(239, 68, 68, 0.1); border: none; color: #ef4444; font-weight: 600; padding: 8px; border-radius: 8px;"><i class="bi bi-box-arrow-right me-1"></i> Keluar</button>
            </form>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <main class="main-wrapper">
        
        <!-- TOP NAVBAR -->
        <header class="top-navbar">
            <button class="btn border-0 d-lg-none p-0 me-3" id="sidebarToggle" style="font-size: 1.5rem; color: var(--admin-primary)">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="nav-widgets">
                <button class="widget-btn" title="Notifikasi">
                    <i class="bi bi-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </button>
            </div>
        </header>

        <!-- CONTENT AREA -->
        <div class="content-area">
            
            @if(session('success'))
                <div class="alert alert-custom alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-custom alert-error alert-dismissible fade show mb-4">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5 mt-1"></i>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="page-header">
                <div>
                    <h1 class="page-title">Manajemen Penitip</h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">CS Dashboard</li>
                        <li class="breadcrumb-item active">Data Penitip</li>
                    </ul>
                </div>
                <button class="btn-custom" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg"></i> Tambah Penitip Baru
                </button>
            </div>

            <div class="dashboard-card">
                <div class="card-header-styled">
                    <h5 class="m-0 font-outfit fw-bold text-dark fs-5">Daftar Penitip Terdaftar</h5>
                    
                    <form action="{{ route('cs.penitip.index') }}" method="GET" class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" name="q" placeholder="Cari nama, NIK, atau email..." value="{{ $search }}">
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Informasi Pengguna</th>
                                <th>Kontak</th>
                                <th>Status Akun</th>
                                <th>Dokumen KTP</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penitips as $index => $penitip)
                                <tr>
                                    <td class="text-muted fw-bold">#{{ $penitips->firstItem() + $index }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $penitip->nama_penitip }}</div>
                                        <div class="text-muted" style="font-size: 0.85rem;"><i class="bi bi-person-badge me-1"></i>NIK: {{ $penitip->no_ktp }}</div>
                                    </td>
                                    <td>
                                        <div><i class="bi bi-envelope me-1 text-muted"></i>{{ $penitip->email }}</div>
                                        <div class="text-muted" style="font-size: 0.85rem;"><i class="bi bi-at me-1"></i>{{ $penitip->username }}</div>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $penitip->status_aktif ? 'status-active' : 'status-inactive' }}">
                                            @if($penitip->status_aktif) <i class="bi bi-check-circle-fill"></i> Aktif
                                            @else <i class="bi bi-shield-lock-fill"></i> Nonaktif @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if($penitip->foto_ktp)
                                            <a href="{{ asset('storage/' . $penitip->foto_ktp) }}" target="_blank" class="ktp-link"><i class="bi bi-file-earmark-image"></i> Lihat Dokumen</a>
                                        @else
                                            <span class="text-muted fst-italic" style="font-size: 0.85rem;">Belum diunggah</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-cell justify-content-end">
                                            <button class="btn-action-icon btn-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $penitip->id_penitip }}" title="Edit Data">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <form action="{{ route('cs.penitip.destroy', $penitip->id_penitip) }}" method="POST" onsubmit="return validateFormDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-delete" title="Hapus Data">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $penitip->id_penitip }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('cs.penitip.update', $penitip->id_penitip) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormUpdate();">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Data Penitip</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="bg-white p-4 rounded-3 border">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Nama Lengkap</label>
                                                                <input type="text" name="nama_penitip" class="form-control" value="{{ $penitip->nama_penitip }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                                                <input type="text" name="no_ktp" class="form-control" value="{{ $penitip->no_ktp }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Email Aktif</label>
                                                                <input type="email" name="email" class="form-control" value="{{ $penitip->email }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Username</label>
                                                                <input type="text" name="username" class="form-control" value="{{ $penitip->username }}" required>
                                                            </div>
                                                            <div class="col-12 mt-4">
                                                                <label class="form-label">Dokumen KTP</label>
                                                                <input type="file" name="foto_ktp" class="form-control" accept="image/*">
                                                                <div class="form-text mt-2">
                                                                    Biarkan kosong jika tidak ingin mengubah foto. 
                                                                    @if($penitip->foto_ktp)
                                                                        <a href="{{ asset('storage/' . $penitip->foto_ktp) }}" target="_blank" class="fw-bold ms-1 text-primary text-decoration-none">Lihat file saat ini <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light border fw-bold text-muted px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn-custom m-0 rounded-pill px-4">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-inbox text-muted mt-3 mb-3 d-block" style="font-size: 3rem;"></i>
                                        <h5 class="fw-bold text-dark font-outfit">Data Tidak Ditemukan</h5>
                                        <p class="text-muted">Tidak ada penitip yang cocok dengan pencarian Anda.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end p-3 border-top">
                    {!! $penitips->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>

        </div>

    </main>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('cs.penitip.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormAdd();">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-person-plus-fill me-2 text-primary"></i>Registrasi Penitip Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <div class="bg-white p-4 rounded-3 border">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_penitip" class="form-control" placeholder="Nama sesuai identitas" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" name="no_ktp" class="form-control" placeholder="16 digit angka KTP" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Valid</label>
                                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Username Login</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username unik" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password Sementara</label>
                                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label">Alamat Domisili</label>
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap beserta kota dan kodepos" required></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label">Unggah Foto KTP</label>
                                    <input type="file" name="foto_ktp" class="form-control" accept="image/*">
                                    <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border fw-bold text-muted px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-custom m-0 rounded-pill px-4"><i class="bi bi-cloud-arrow-up me-2"></i>Simpan Data Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-open');
        });

        function validateFormUpdate() { return confirm('Pastikan data yang diubah sudah benar. Lanjutkan pembaruan data?'); }
        function validateFormAdd() { return confirm('Apakah semua data penitip baru sudah diisi dengan benar?'); }
        function validateFormDelete() { return confirm('PERINGATAN: Menghapus data ini bersifat permanen. Yakin ingin menghapus penitip ini dari sistem?'); }
    </script>
</body>
</html>

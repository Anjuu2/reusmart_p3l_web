<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Dashboard | ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- jQuery (Needed for some admin scripts if any exist in child views) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        :root {
            --admin-primary: #0f172a;      
            --admin-secondary: #1e293b;    
            --admin-accent: #f59e0b;       /* Orange accent for Warehouse/Logistics */
            --admin-accent-dark: #d97706;
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
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text-main);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        .menu-item.active .menu-link { background: var(--admin-accent); color: white; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3); }

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
            flex: 1;
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
            background-color: var(--admin-bg);
        }

        /* Basic overrides for child views so they look okay even if not rewritten */
        .content-area .card { border: 1px solid var(--admin-border); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); margin-bottom: 24px;}
        .content-area .card-header { background: var(--admin-surface); border-bottom: 1px solid var(--admin-border); padding: 15px 20px; border-radius: var(--radius-lg) var(--radius-lg) 0 0;}
        .content-area .card-body { padding: 20px; }
        .content-area .btn-primary { background-color: var(--admin-accent); border-color: var(--admin-accent); color: white;}
        .content-area .btn-primary:hover { background-color: var(--admin-accent-dark); border-color: var(--admin-accent-dark);}

        /* Main Footer */
        .main-footer {
            background-color: var(--admin-surface);
            border-top: 1px solid var(--admin-border);
            padding: 15px 30px;
            color: var(--admin-text-light);
            font-size: 0.85rem;
            text-align: center;
            font-weight: 500;
        }

        /* Modals */
        .modal-content { border-radius: var(--radius-lg); border: none; box-shadow: var(--shadow-lg); overflow: hidden;}
        .modal-header { background: var(--admin-surface); border-bottom: 1px solid var(--admin-border); padding: 20px 25px; }
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--admin-primary); }
        .modal-body { padding: 25px; background: #f8fafc;}
        .modal-footer { padding: 20px 25px; border-top: 1px solid var(--admin-border); background: var(--admin-surface); }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .sidebar-open .sidebar { transform: translateX(0); }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="{{ route('dashboard.pegawai_gudang') }}" class="sidebar-brand">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo">
            <span>Warehouse<span>App</span></span>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-label">Inventaris Gudang</li>
            <li class="menu-item {{ request()->routeIs('pegawai_gudang.notaPenitipan.*') ? 'active' : '' }}">
                <a href="{{ route('pegawai_gudang.notaPenitipan.index') }}" class="menu-link"><i class="bi bi-file-earmark-text"></i> Nota Penitipan</a>
            </li>
            <li class="menu-item {{ request()->routeIs('pegawai_gudang.barangTitipan.*') ? 'active' : '' }}">
                <a href="{{ route('pegawai_gudang.barangTitipan.index') }}" class="menu-link"><i class="bi bi-box-seam"></i> Barang Titipan</a>
            </li>
            <li class="menu-item {{ request()->routeIs('pegawai_gudang.barang.pengembalian') ? 'active' : '' }}">
                <a href="{{ route('pegawai_gudang.barang.pengembalian') }}" class="menu-link"><i class="bi bi-arrow-return-left"></i> Pengembalian Barang</a>
            </li>
            <li class="menu-label">Logistik</li>
            <li class="menu-item {{ request()->routeIs('pegawai_gudang.pengiriman.*') ? 'active' : '' }}">
                <a href="{{ route('pegawai_gudang.pengiriman.index') }}" class="menu-link"><i class="bi bi-truck"></i> Pengiriman Barang</a>
            </li>
            <li class="menu-item {{ request()->routeIs('pegawai_gudang.cetakNotaIndex') ? 'active' : '' }}">
                <a href="{{ route('pegawai_gudang.cetakNotaIndex') }}" class="menu-link"><i class="bi bi-printer"></i> Cetak Dokumen</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Warehouse+Staff&background=f59e0b&color=fff" alt="User" class="user-avatar">
                <div class="user-details">
                    <h6>{{ Auth::user()->nama_pegawai ?? 'Kepala Gudang' }}</h6>
                    <span>Divisi Logistik</span>
                </div>
            </div>
            <button class="btn btn-sm w-100 mt-3" data-bs-toggle="modal" data-bs-target="#logoutModal" style="background: rgba(239, 68, 68, 0.1); border: none; color: #ef4444; font-weight: 600; padding: 8px; border-radius: 8px;">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar
            </button>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">
        
        <!-- TOP NAVBAR -->
        <header class="top-navbar">
            <button class="btn border-0 d-lg-none p-0 me-3" id="sidebarToggle" style="font-size: 1.5rem; color: var(--admin-primary)">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="nav-widgets">
                <button class="widget-btn" title="Notifikasi Gudang">
                    <i class="bi bi-bell"></i>
                </button>
                <div class="text-end d-none d-md-block ms-2">
                    <div class="fw-bold" style="font-size: 0.9rem;">Warehouse Terminal</div>
                    <div class="text-muted" id="clock" style="font-size: 0.8rem;">--:--:--</div>
                </div>
            </div>
        </header>

        <!-- CONTENT AREA (Yield isi) -->
        <main class="content-wrapper content-area">
            @yield('isi')
        </main>

        <!-- FOOTER -->
        <footer class="main-footer">
            <strong>&copy; 2025 ReUseMart Warehouse System.</strong> Selalu ada untuk Anda.
        </footer>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0 pb-4 px-4 bg-white">
                    <div class="mb-4 text-danger">
                        <i class="bi bi-box-arrow-right" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="mb-3 font-outfit fw-bold text-dark">Akhiri Sesi?</h4>
                    <p class="text-muted mb-4">Apakah Anda yakin ingin keluar dari sistem Gudang? Semua perubahan yang belum disimpan mungkin akan hilang.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light border fw-bold px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <a href="{{url('/')}}" class="btn btn-danger fw-bold px-4 rounded-pill">Ya, Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-open');
        });

        // Simple real-time clock for logistics dashboard
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const clockEl = document.getElementById('clock');
            if(clockEl) clockEl.innerText = timeStr + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
    
    <!-- Child scripts yield -->
    @stack('scripts')
</body>
</html>
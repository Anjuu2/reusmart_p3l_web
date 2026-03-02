<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Portal | ReUseMart</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --cs-dark: #0f172a;       
            --cs-accent: #10b981;     /* Green accent for Customer Service */
            --cs-accent-hover: #059669;
            --cs-surface: #1e293b;
            --cs-bg: #f8fafc;
            
            --sidebar-width: 280px;
            --header-height: 70px;
            
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-pill: 50px;
            
            --shadow-sm: 0 2px 4px rgba(15, 23, 42, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(15, 23, 42, 0.1), 0 2px 4px -1px rgba(15, 23, 42, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(15, 23, 42, 0.1), 0 4px 6px -2px rgba(15, 23, 42, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--cs-bg);
            color: #334155;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--cs-dark);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            color: #f8fafc;
        }

        .sidebar-brand {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            color: var(--cs-accent);
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .nav-menu {
            padding: 1.5rem 1rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            font-weight: 700;
            margin: 1.5rem 0 0.5rem 1rem;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link i {
            font-size: 1.25rem;
            margin-right: 1rem;
            color: #94a3b8;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--cs-accent);
        }

        .nav-link:hover i {
            color: var(--cs-accent);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(16, 185, 129, 0.05) 100%);
            color: var(--cs-accent);
            border-left: 3px solid var(--cs-accent);
            font-weight: 600;
        }

        .nav-link.active i {
            color: var(--cs-accent);
        }

        /* User Footer */
        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.05);
            background: rgba(0,0,0,0.2);
        }
        
        .cs-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .cs-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--cs-accent), #34d399);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .top-header {
            height: var(--header-height);
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--cs-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Page Content */
        .content-body {
            padding: 2rem;
            flex-grow: 1;
        }

        /* Buttons & Components */
        .btn-logout {
            background-color: transparent;
            color: #ef4444;
            border: 1px solid #fee2e2;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-pill);
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: #fef2f2;
            border-color: #ef4444;
            color: #dc2626;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ url('dashboard.cs') }}" class="sidebar-brand">
            <i class="bi bi-headset me-2"></i> ReUseMart <span style="font-size: 0.8rem; font-weight: 500; color:var(--cs-accent); margin-left: 8px; border: 1px solid var(--cs-accent); padding: 2px 6px; border-radius: 4px;">CS</span>
        </a>

        <div class="nav-menu">
            <div class="nav-label">Main Services</div>
            
            <div class="nav-item">
                <a href="{{ route('cs.penitip.index') }}" class="nav-link {{ request()->routeIs('cs.penitip.index') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Verifikasi Penitip</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('cs.pembayaran.index') }}" class="nav-link {{ request()->routeIs('cs.pembayaran.index') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i>
                    <span>Verifikasi Mutasi (Pay)</span>
                </a>
            </div>
            
            <div class="nav-label mt-4">Support & Tickets</div>

            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <span>Live Chat Users</span>
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="cs-profile">
                <div class="cs-avatar"><i class="bi bi-headset"></i></div>
                <div>
                    <h6 class="m-0 text-white font-outfit" style="font-size: 0.95rem;">Customer SRV</h6>
                    <span class="text-muted" style="font-size: 0.75rem;">Support Access</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header d-flex justify-content-between">
            <h1 class="header-title">
                <span class="badge bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 36px; height: 36px;">
                    <i class="bi bi-activity"></i>
                </span>
                Customer Service Center
            </h1>
            
            <div class="header-actions">
                <button type="button" class="btn-logout" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right"></i> Akhiri Shift
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <div class="content-body">
            <!-- This is where the cs.penitip.index or cs.pembayaran.index content goes -->
            @yield('isi')
        </div>
    </main>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: var(--radius-lg); border: none;">
                <div class="modal-header border-0 bg-danger bg-opacity-10 text-danger" style="border-top-left-radius: var(--radius-lg); border-top-right-radius: var(--radius-lg);">
                    <h5 class="modal-title font-outfit fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Selesaikan Shift Kerja?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="mb-0 fs-5">Sesi Anda sebagai Customer Service akan berakhir.<br>Lanjutkan proses logout?</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center pt-0 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Lanjut Bekerja</button>
                    <a href="{{url('/')}}" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm"><i class="bi bi-box-arrow-right me-2"></i>Akhiri Sesi</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
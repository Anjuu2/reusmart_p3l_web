<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal | ReUseMart</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --owner-dark: #0f172a;       /* Deep slate for luxury feel */
            --owner-gold: #f59e0b;       /* Premium Gold accent */
            --owner-gold-hover: #d97706;
            --owner-surface: #1e293b;
            --owner-bg: #f8fafc;
            
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
            background-color: var(--owner-bg);
            color: #334155;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--owner-dark);
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
            color: var(--owner-gold);
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

        .nav-link:hover, .nav-link-sub:hover {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--owner-gold);
        }

        .nav-link:hover i {
            color: var(--owner-gold);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0.05) 100%);
            color: var(--owner-gold);
            border-left: 3px solid var(--owner-gold);
            font-weight: 600;
        }

        .nav-link.active i {
            color: var(--owner-gold);
        }

        .sub-menu {
            margin-left: 2rem;
            margin-top: 0.25rem;
            list-style: none;
            padding-left: 0;
            border-left: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link-sub {
            display: block;
            padding: 0.5rem 1rem;
            color: #94a3b8;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .nav-link-sub.active {
            color: var(--owner-gold);
            font-weight: 600;
            position: relative;
        }
        
        .nav-link-sub.active::before {
            content: '';
            position: absolute;
            left: -1px;
            top: 50%;
            transform: translateY(-50%);
            height: 12px;
            width: 2px;
            background-color: var(--owner-gold);
        }

        /* User Footer */
        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.05);
            background: rgba(0,0,0,0.1);
        }
        
        .owner-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .owner-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--owner-gold), #fbbf24);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.3);
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
            color: var(--owner-dark);
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
        
        .btn-premium {
            background: linear-gradient(135deg, var(--owner-gold), #fbbf24);
            color: #fff !important;
            border: none;
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
            border-radius: var(--radius-pill);
            transition: all 0.3s ease;
        }
        
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(245, 158, 11, 0.4);
        }

        /* Card System */
        .card {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            box-shadow: var(--shadow-md);
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
        <a href="{{ route('dashboard.owner') }}" class="sidebar-brand">
            <i class="bi bi-box-seam me-2"></i> ReUseMart <span style="font-size: 0.8rem; font-weight: 500; color:var(--owner-gold); margin-left: 8px; border: 1px solid var(--owner-gold); padding: 2px 6px; border-radius: 4px;">OWNER</span>
        </a>

        <div class="nav-menu">
            <div class="nav-label">CSR & Filantropi</div>
            
            <div class="nav-item">
                <a href="#donasiSubmenu" data-bs-toggle="collapse" class="nav-link {{ request()->routeIs('dashboard.owner') || request()->routeIs('owner.donasi.*') ? 'active' : '' }}" aria-expanded="{{ request()->routeIs('dashboard.owner') || request()->routeIs('owner.donasi.*') ? 'true' : 'false' }}">
                    <i class="bi bi-gift-fill"></i>
                    <span>Manajemen Donasi</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 0.8rem; margin-right: 0;"></i>
                </a>
                <ul class="collapse sub-menu {{ request()->routeIs('dashboard.owner') || request()->routeIs('owner.donasi.*') ? 'show' : '' }}" id="donasiSubmenu">
                    <li>
                        <a href="{{ route('dashboard.owner') }}" class="nav-link-sub {{ request()->routeIs('dashboard.owner') ? 'active' : '' }}">
                            Kelola Permintaan
                        </a>
                    </li>
                    <li class="mt-2 text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px; text-transform: uppercase;">Histori Mitra</li>
                    @foreach($daftarOrganisasi as $org)
                        <li>
                            <a href="{{ route('owner.donasi.history.organisasi', ['id' => $org->id_organisasi]) }}" class="nav-link-sub {{ request()->routeIs('owner.donasi.history.organisasi') && request()->route('id') == $org->id_organisasi ? 'active' : '' }}">
                                {{ $org->nama_organisasi }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="owner-profile">
                <div class="owner-avatar">O</div>
                <div>
                    <h6 class="m-0 text-white font-outfit" style="font-size: 0.95rem;">Owner</h6>
                    <span class="text-muted" style="font-size: 0.75rem;">Executive Portal</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header d-flex justify-content-between">
            <h1 class="header-title">
                <span class="badge bg-dark bg-opacity-10 text-dark rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 36px; height: 36px;">
                    <i class="bi bi-briefcase-fill text-warning"></i>
                </span>
                Owner Executive Board
            </h1>
            
            <div class="header-actions">
                <button type="button" class="btn-logout" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <div class="content-body">
            @yield('isi')
        </div>
    </main>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: var(--radius-lg); border: none;">
                <div class="modal-header border-0 bg-danger bg-opacity-10 text-danger" style="border-top-left-radius: var(--radius-lg); border-top-right-radius: var(--radius-lg);">
                    <h5 class="modal-title font-outfit fw-bold" id="logoutModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="mb-0 fs-5">Apakah Anda yakin ingin keluar dari eksekutif portal?</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center pt-0 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <a href="{{url('/')}}" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Ya, Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            // Submenu toggle behavior
            $('.nav-item > .nav-link').click(function(e){
                if($(this).attr('data-bs-toggle') === 'collapse') {
                    $(this).find('.bi-chevron-down').toggleClass('rotate-180');
                }
            });
        });
    </script>
    <style>
        .rotate-180 { transform: rotate(180deg); transition: transform 0.3s ease; }
    </style>
</body>
</html>
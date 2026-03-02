<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --admin-primary: #0f172a;      /* Dark slate */
            --admin-secondary: #1e293b;    /* Lighter slate */
            --admin-accent: #3b82f6;       /* Blue accent */
            --admin-success: #10b981;
            --admin-warning: #f59e0b;
            --admin-danger: #ef4444;
            --admin-bg: #f8fafc;
            --admin-surface: #ffffff;
            --admin-text-main: #334155;
            --admin-text-light: #64748b;
            --admin-border: #e2e8f0;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text-main);
            overflow-x: hidden;
        }

        /* Typography */
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
        .menu-item.active .menu-link { background: var(--admin-accent); color: white; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }

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
        .nav-search {
            position: relative;
            width: 300px;
        }
        .nav-search input {
            width: 100%; padding: 10px 15px 10px 40px; border-radius: 8px; border: 1px solid var(--admin-border);
            background: var(--admin-bg); font-size: 0.9rem; transition: all 0.2s;
        }
        .nav-search input:focus { border-color: var(--admin-accent); outline: none; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); background: white;}
        .nav-search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--admin-text-light); }

        .nav-widgets { display: flex; align-items: center; gap: 20px; }
        .widget-btn {
            position: relative; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: var(--admin-text-main); font-size: 1.1rem; background: var(--admin-bg); cursor: pointer; transition: all 0.2s;
        }
        .widget-btn:hover { background: #e2e8f0; color: var(--admin-primary); }
        .badge-indicator { position: absolute; top: 0; right: 0; width: 10px; height: 10px; background: var(--admin-danger); border-radius: 50%; border: 2px solid var(--admin-surface); }

        /* ====== MAIN CONTENT ====== */
        .content-area {
            padding: 30px;
            flex: 1;
        }

        .page-title-box { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-title { margin: 0; font-size: 1.5rem; }
        .breadcrumb { display: flex; gap: 8px; font-size: 0.85rem; color: var(--admin-text-light); margin: 0; list-style: none; padding: 0;}
        .breadcrumb-item.active { color: var(--admin-primary); font-weight: 600; }
        .breadcrumb-item + .breadcrumb-item::before { content: "/"; margin-right: 8px; color: #cbd5e1; }

        /* Stat Cards */
        .stat-card {
            background: var(--admin-surface); border-radius: 16px; padding: 24px; border: 1px solid var(--admin-border);
            display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow-sm); transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .stat-info h6 { font-size: 0.9rem; color: var(--admin-text-light); margin-bottom: 8px; font-weight: 600; text-transform: uppercase;}
        .stat-info h2 { font-size: 2rem; margin: 0; color: var(--admin-primary); letter-spacing: -1px;}
        .stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-green { background: #ecfdf5; color: #10b981; }
        .icon-orange { background: #fffbeb; color: #f59e0b; }
        .icon-purple { background: #faf5ff; color: #a855f7; }

        .stat-trend { font-size: 0.85rem; margin-top: 10px; display: flex; align-items: center; gap: 5px;}
        .trend-up { color: var(--admin-success); }
        .trend-down { color: var(--admin-danger); }

        /* Charts & Tables */
        .dashboard-card { background: var(--admin-surface); border-radius: 16px; border: 1px solid var(--admin-border); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 24px;}
        .card-header { background: transparent; padding: 20px 24px; border-bottom: 1px solid var(--admin-border); display: flex; justify-content: space-between; align-items: center; }
        .card-title { margin: 0; font-size: 1.1rem; color: var(--admin-primary); }
        .card-body { padding: 24px; }

        .table-modern { margin: 0; width: 100%; border-collapse: separate; border-spacing: 0; }
        .table-modern th { background: #f8fafc; color: var(--admin-text-light); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; padding: 12px 16px; border-bottom: 1px solid var(--admin-border); border-top: 1px solid var(--admin-border); }
        .table-modern td { padding: 16px; border-bottom: 1px solid var(--admin-border); vertical-align: middle; font-size: 0.95rem; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        .table-modern tbody tr:hover { background: #f8fafc; }

        .status-badge { padding: 4px 10px; border-radius: var(--radius-pill); font-size: 0.8rem; font-weight: 600; }
        .status-active { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef3c7; color: #b45309; }

        .btn-action-sm { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; background: #f1f5f9; color: var(--admin-text-main); transition: all 0.2s; border: none;}
        .btn-action-sm:hover { background: #e2e8f0; color: var(--admin-primary); }

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
            <span>ReUseMart</span>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-label">Menu Utama</li>
            <li class="menu-item active">
                <a href="#" class="menu-link"><i class="bi bi-grid-1x2-fill"></i> Dashboard Admin</a>
            </li>
            <li class="menu-label">Manajemen</li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-people-fill"></i> Kelola Pengguna</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-person-badge-fill"></i> Kelola Pegawai</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-tags-fill"></i> Kategori Barang</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-box-seam-fill"></i> Daftar Barang</a>
            </li>
            <li class="menu-label">Sistem</li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-file-earmark-text-fill"></i> Laporan Transaksi</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-gear-fill"></i> Pengaturan Sistem</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Administrator&background=3b82f6&color=fff" alt="User" class="user-avatar">
                <div class="user-details">
                    <h6>Administrator</h6>
                    <span>Admin System</span>
                </div>
            </div>
            <!-- Logout Button placeholder -->
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger w-100" style="background: rgba(239, 68, 68, 0.1); border: none; color: #ef4444; font-weight: 600;"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <main class="main-wrapper">
        
        <!-- TOP NAVBAR -->
        <header class="top-navbar">
            <div class="d-flex align-items-center">
                <!-- Hamburger Menu for Mobile -->
                <button class="btn border-0 d-lg-none me-2" id="sidebarToggle" style="font-size: 1.5rem;">
                    <i class="bi bi-list"></i>
                </button>
                <div class="nav-search d-none d-md-block">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Global search...">
                </div>
            </div>

            <div class="nav-widgets">
                <div class="widget-btn" title="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-indicator"></span>
                </div>
                <div class="widget-btn" title="Messages">
                    <i class="bi bi-chat-dots"></i>
                </div>
            </div>
        </header>

        <!-- CONTENT AREA -->
        <div class="content-area">
            
            <div class="page-title-box">
                <h1 class="page-title">Dashboard Overview</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>

            <!-- Dashboard Stats -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Total Pengguna</h6>
                            <h2>1,248</h2>
                            <div class="stat-trend trend-up"><i class="bi bi-arrow-up-right"></i> +12% dari bulan lalu</div>
                        </div>
                        <div class="stat-icon icon-blue"><i class="bi bi-people"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Total Transaksi</h6>
                            <h2>856</h2>
                            <div class="stat-trend trend-up"><i class="bi bi-arrow-up-right"></i> +5.4% dari bulan lalu</div>
                        </div>
                        <div class="stat-icon icon-green"><i class="bi bi-cart-check"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Barang Penitipan</h6>
                            <h2>412</h2>
                            <div class="stat-trend trend-down"><i class="bi bi-arrow-down-right"></i> -2.1% dari bulan lalu</div>
                        </div>
                        <div class="stat-icon icon-orange"><i class="bi bi-box-seam"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Pegawai Aktif</h6>
                            <h2>24</h2>
                            <div class="stat-trend text-muted"><i class="bi bi-dash"></i> Tidak ada perubahan</div>
                        </div>
                        <div class="stat-icon icon-purple"><i class="bi bi-person-badge"></i></div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-8">
                    <!-- Chart Selection -->
                    <div class="dashboard-card h-100">
                        <div class="card-header">
                            <h5 class="card-title">Grafik Transaksi Bulanan</h5>
                            <button class="btn btn-sm btn-light border"><i class="bi bi-download"></i> Export</button>
                        </div>
                        <div class="card-body">
                            <canvas id="trxChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Quick Actions or Logs -->
                    <div class="dashboard-card h-100">
                        <div class="card-header">
                            <h5 class="card-title">Aktivitas Terbaru System</h5>
                        </div>
                        <div class="card-body p-0">
                            <!-- Timeline logic -->
                            <div class="p-3 border-bottom d-flex gap-3 align-items-center">
                                <div style="width: 10px; height: 10px; border-radius: 50%; background: var(--admin-success);"></div>
                                <div>
                                    <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">Registrasi Pengguna Baru</p>
                                    <span class="text-muted" style="font-size: 0.8rem;">2 menit lalu • Sistem Otomatis</span>
                                </div>
                            </div>
                            <div class="p-3 border-bottom d-flex gap-3 align-items-center">
                                <div style="width: 10px; height: 10px; border-radius: 50%; background: var(--admin-warning);"></div>
                                <div>
                                    <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">Laporan Pembayaran Tertunda</p>
                                    <span class="text-muted" style="font-size: 0.8rem;">1 jam lalu • Gateway API</span>
                                </div>
                            </div>
                            <div class="p-3 border-bottom d-flex gap-3 align-items-center">
                                <div style="width: 10px; height: 10px; border-radius: 50%; background: var(--admin-accent);"></div>
                                <div>
                                    <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">Perubahan Kategori Barang</p>
                                    <span class="text-muted" style="font-size: 0.8rem;">3 jam lalu • Operator IT</span>
                                </div>
                            </div>
                             <div class="p-3 d-flex gap-3 align-items-center">
                                <div style="width: 10px; height: 10px; border-radius: 50%; background: var(--admin-danger);"></div>
                                <div>
                                    <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">Server Pencadangan (Backup)</p>
                                    <span class="text-muted" style="font-size: 0.8rem;">Kemarin • Selesai dengan peringatan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Pengguna Terbaru</h5>
                    <a href="#" class="btn btn-sm" style="color: var(--admin-accent); font-weight: 600;">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Tgl Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="fw-bold text-dark">Budi Santoso</div></td>
                                <td>budi.s@example.com</td>
                                <td>Pembeli</td>
                                <td><span class="status-badge status-active">Aktif</span></td>
                                <td>15 Mar 2025</td>
                                <td>
                                    <button class="btn-action-sm"><i class="bi bi-eye"></i></button>
                                    <button class="btn-action-sm"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="fw-bold text-dark">Siti Aminah</div></td>
                                <td>siti.a@example.com</td>
                                <td>Penitip</td>
                                <td><span class="status-badge status-pending">Menunggu Verifikasi</span></td>
                                <td>14 Mar 2025</td>
                                <td>
                                    <button class="btn-action-sm"><i class="bi bi-eye"></i></button>
                                    <button class="btn-action-sm"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="fw-bold text-dark">Ahmad Wijaya</div></td>
                                <td>ahmad.ww@example.com</td>
                                <td>Pegawai Gudang</td>
                                <td><span class="status-badge status-active">Aktif</span></td>
                                <td>12 Mar 2025</td>
                                <td>
                                    <button class="btn-action-sm"><i class="bi bi-eye"></i></button>
                                    <button class="btn-action-sm"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <footer class="mt-auto px-4 py-3 border-top" style="background: var(--admin-surface); color: var(--admin-text-light); font-size: 0.85rem; text-align: center;">
            &copy; 2025 ReUseMart Backoffice System. All Rights Reserved.
        </footer>
    </main>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-open');
        });

        // ChartJS init
        const ctx = document.getElementById('trxChart').getContext('2d');
        const trxChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Pendapatan Transaksi',
                    data: [12000000, 19000000, 15000000, 22000000, 18000000, 25000000],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] }, ticks: { callback: function(value) { return 'Rp' + value / 1000000 + 'M'; } } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>

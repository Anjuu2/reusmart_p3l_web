<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard | ReUseMart</title>

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
            --admin-primary: #0f172a;      
            --admin-secondary: #1e293b;    
            --admin-accent: #eab308;       /* Executive Gold/Amber */
            --admin-accent-dark: #ca8a04;
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
        .menu-item.active .menu-link { background: var(--admin-accent); color: var(--admin-primary); box-shadow: 0 4px 12px rgba(234, 179, 8, 0.3); font-weight: 700;}

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: var(--admin-secondary);
        }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 10px; background: #cbd5e1; }
        .user-details h6 { margin: 0; color: white; font-size: 0.95rem; font-family: 'Plus Jakarta Sans', sans-serif;}
        .user-details span { font-size: 0.8rem; color: #eab308; font-weight: 600;}

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
        }

        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;}
        .page-title { margin: 0; font-size: 1.6rem; }
        .breadcrumb { display: flex; gap: 8px; font-size: 0.85rem; color: var(--admin-text-light); margin: 0; list-style: none; padding: 0;}
        .breadcrumb-item.active { color: var(--admin-primary); font-weight: 600; }
        .breadcrumb-item + .breadcrumb-item::before { content: "/"; margin-right: 8px; color: #cbd5e1; }

        /* Stat Cards */
        .stat-card {
            background: var(--admin-surface); border-radius: var(--radius-lg); padding: 24px; border: 1px solid var(--admin-border);
            display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow-sm); transition: transform 0.2s; height: 100%;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .stat-info h6 { font-size: 0.9rem; color: var(--admin-text-light); margin-bottom: 8px; font-weight: 600; text-transform: uppercase;}
        .stat-info h2 { font-size: 2rem; margin: 0; color: var(--admin-primary); letter-spacing: -1px;}
        .stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        
        /* Premium Executive Colors */
        .icon-gold { background: #fefce8; color: #eab308; border: 1px solid #fef08a;}
        .icon-emerald { background: #ecfdf5; color: #10b981; border: 1px solid #a7f3d0;}
        .icon-indigo { background: #eef2ff; color: #6366f1; border: 1px solid #c7d2fe;}
        .icon-rose { background: #fff1f2; color: #f43f5e; border: 1px solid #fecdd3;}

        .stat-trend { font-size: 0.85rem; margin-top: 10px; display: flex; align-items: center; gap: 5px; font-weight: 600;}
        .trend-up { color: var(--admin-success); }
        .trend-down { color: var(--admin-danger); }

        .dashboard-card { background: var(--admin-surface); border-radius: var(--radius-lg); border: 1px solid var(--admin-border); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 24px;}
        .card-header-styled { padding: 20px 24px; border-bottom: 1px solid var(--admin-border); display: flex; justify-content: space-between; align-items: center; background: transparent;}
        
        .main-footer {
            background-color: var(--admin-surface);
            border-top: 1px solid var(--admin-border);
            padding: 15px 30px;
            color: var(--admin-text-light);
            font-size: 0.85rem;
            text-align: center;
        }

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
            <li class="menu-label">Executive View</li>
            <li class="menu-item active">
                <a href="#" class="menu-link"><i class="bi bi-graph-up-arrow"></i> Ringkasan Bisnis</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-cash-coin"></i> Laporan Keuangan</a>
            </li>
            
            <li class="menu-label">Manajemen Organisasi</li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-buildings"></i> Kinerja Cabang</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-people"></i> Kinerja Pegawai</a>
            </li>
            
            <li class="menu-label">Sistem Terpusat</li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-shield-check"></i> Audit Trail</a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link"><i class="bi bi-gear-wide-connected"></i> Konfigurasi Bisnis</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Owner&background=eab308&color=fff" alt="User" class="user-avatar">
                <div class="user-details">
                    <h6>{{ Auth::user()->nama_pegawai ?? 'CEO / Owner' }}</h6>
                    <span>Pemilik Bisnis</span>
                </div>
            </div>
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn w-100" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #cbd5e1; font-weight: 600; padding: 8px; border-radius: 8px; transition: 0.2s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#ef4444'; this.style.borderColor='rgba(239, 68, 68, 0.2)';" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='#cbd5e1'; this.style.borderColor='rgba(255,255,255,0.1)';">
                    <i class="bi bi-power me-1"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">
        
        <!-- TOP NAVBAR -->
        <header class="top-navbar">
            <button class="btn border-0 d-lg-none p-0 me-3" id="sidebarToggle" style="font-size: 1.5rem; color: var(--admin-primary)">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="d-flex align-items-center bg-light px-3 py-2 rounded-pill ms-2 border" style="font-size: 0.85rem;">
                <span class="fw-bold text-dark me-2">Periode Aktif:</span>
                <span class="text-muted"><i class="bi bi-calendar3 me-1"></i> Quartal 1, 2025</span>
            </div>

            <div class="nav-widgets">
                <button class="btn btn-sm btn-outline-secondary rounded-pill fw-bold" style="font-size: 0.8rem;">
                    <i class="bi bi-cloud-download me-1"></i> Unduh Laporan PDF
                </button>
                <div style="width: 1px; height: 24px; background: #e2e8f0; margin: 0 5px;"></div>
                <button class="widget-btn" title="Pesan Sistem">
                    <i class="bi bi-envelope"></i>
                </button>
            </div>
        </header>

        <!-- CONTENT AREA -->
        <main class="content-area">
            
            <div class="page-header">
                <div>
                    <h1 class="page-title">Executive Overview</h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">Owner Dashboard</li>
                        <li class="breadcrumb-item active">Ringkasan Keuangan</li>
                    </ul>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Total Pendapatan (YTD)</h6>
                            <h2>Rp 1.24M</h2>
                            <div class="stat-trend trend-up"><i class="bi bi-graph-up-arrow"></i> +14.5% dari target</div>
                        </div>
                        <div class="stat-icon icon-emerald"><i class="bi bi-cash-coin"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Volume Transaksi</h6>
                            <h2>14,502</h2>
                            <div class="stat-trend trend-up"><i class="bi bi-graph-up-arrow"></i> +8.2% vs Q4 2024</div>
                        </div>
                        <div class="stat-icon icon-indigo"><i class="bi bi-cart-check"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Pengguna Aktif</h6>
                            <h2>8,430</h2>
                            <div class="stat-trend trend-up"><i class="bi bi-graph-up-arrow"></i> +4.1% pertumbuhan</div>
                        </div>
                        <div class="stat-icon icon-gold"><i class="bi bi-people"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Tingkat Retensi</h6>
                            <h2>68.5%</h2>
                            <div class="stat-trend trend-down"><i class="bi bi-graph-down-arrow"></i> -1.2% peringatan ringan</div>
                        </div>
                        <div class="stat-icon icon-rose"><i class="bi bi-arrow-repeat"></i></div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4 mb-4">
                <div class="col-lg-8">
                    <div class="dashboard-card h-100">
                        <div class="card-header-styled">
                            <h5 class="m-0 font-outfit fw-bold text-dark fs-5">Analisis Pendapatan vs Target</h5>
                            <select class="form-select form-select-sm" style="width: auto; font-weight: 600; cursor: pointer;">
                                <option>Tahun 2025</option>
                                <option>Tahun 2024</option>
                            </select>
                        </div>
                        <div class="p-4">
                            <canvas id="revenueChart" height="280"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="dashboard-card h-100">
                        <div class="card-header-styled">
                            <h5 class="m-0 font-outfit fw-bold text-dark fs-5">Komposisi Transaksi</h5>
                        </div>
                        <div class="p-4 d-flex justify-content-center align-items-center" style="height: 280px;">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Operational Highlights -->
            <div class="dashboard-card mb-0">
                <div class="card-header-styled">
                    <h5 class="m-0 font-outfit fw-bold text-dark fs-5">Kinerja Divisi Logistik & Staff</h5>
                    <button class="btn btn-sm text-primary fw-bold">Detail Laporan <i class="bi bi-arrow-right"></i></button>
                </div>
                <div class="p-0 table-responsive border-0">
                    <table class="table mb-0 align-middle">
                        <thead class="bg-light text-muted" style="font-size: 0.85rem; text-transform: uppercase; font-weight: 600;">
                            <tr>
                                <th class="py-3 px-4 border-bottom-0">Divisi Operasional</th>
                                <th class="py-3 px-4 border-bottom-0">SLA Pencapaian</th>
                                <th class="py-3 px-4 border-bottom-0">Tiket/Task Aktif</th>
                                <th class="py-3 px-4 border-bottom-0">Status Health</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-3 px-4"><div class="fw-bold text-dark"><i class="bi bi-headset me-2 text-primary"></i>Customer Service</div></td>
                                <td class="py-3 px-4"><div class="fw-bold text-success">98.5% <i class="bi bi-caret-up-fill small"></i></div></td>
                                <td class="py-3 px-4">12 tiket antrean</td>
                                <td class="py-3 px-4"><span class="badge bg-success rounded-pill px-3">Optimal</span></td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4"><div class="fw-bold text-dark"><i class="bi bi-box-seam me-2 text-warning"></i>Gudang & Logistik</div></td>
                                <td class="py-3 px-4"><div class="fw-bold text-warning">91.2% <i class="bi bi-caret-down-fill small"></i></div></td>
                                <td class="py-3 px-4">45 barang tertunda sortir</td>
                                <td class="py-3 px-4"><span class="badge bg-warning text-dark rounded-pill px-3">Perlu Perhatian</span></td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 border-bottom-0"><div class="fw-bold text-dark"><i class="bi bi-check-circle me-2 text-info"></i>Quality Check</div></td>
                                <td class="py-3 px-4 border-bottom-0"><div class="fw-bold text-success">99.1% <i class="bi bi-caret-up-fill small"></i></div></td>
                                <td class="py-3 px-4 border-bottom-0">3 pengecekan aktif</td>
                                <td class="py-3 px-4 border-bottom-0"><span class="badge bg-success rounded-pill px-3">Optimal</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

        <!-- FOOTER -->
        <footer class="main-footer">
            &copy; 2025 ReUseMart Executive Portal. Confidential Information.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-open');
        });

        // Revenue Chart (Line)
        const ctxRev = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRev, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Pendapatan Aktual',
                        data: [150, 230, 180, 290, 250, 310],
                        borderColor: '#eab308',
                        backgroundColor: 'rgba(234, 179, 8, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Target Pendapatan',
                        data: [140, 200, 210, 240, 270, 290],
                        borderColor: '#cbd5e1',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        tension: 0.4,
                        fill: false,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] }, ticks: { callback: function(value){ return value + ' Jt'; } } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Category Chart (Doughnut)
        const ctxCat = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCat, {
            type: 'doughnut',
            data: {
                labels: ['Elektronik', 'Pakaian', 'Furnitur', 'Lainnya'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
                }
            }
        });
    </script>
</body>
</html>

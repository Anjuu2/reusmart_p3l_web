<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian | ReUseMart</title>

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
        .nav-links a::after { content: ''; position: absolute; width: 0; height: 2px; bottom: -5px; left: 0; background: var(--gradient-primary); transition: width 0.3s ease; border-radius: 2px;}
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }

        .nav-actions { display: flex; align-items: center; gap: 12px; }
        .action-btn {
            width: 44px; height: 44px; border-radius: var(--radius-pill); background: var(--color-surface);
            display: flex; align-items: center; justify-content: center; color: var(--color-text-main);
            font-size: 1.2rem; border: 1px solid var(--color-border); transition: all 0.2s ease;
        }
        .action-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);}

        /* Main Content Container */
        .main-container {
            flex: 1;
            padding: 40px 0;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }
        .page-title span { color: var(--color-primary); }

        .btn-back {
            background: var(--color-surface);
            color: var(--color-text-main);
            border: 1px solid var(--color-border);
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover { background: #f1f5f9; transform: translateX(-3px); }

        /* Search Bar */
        .search-container {
            background: var(--color-surface);
            border-radius: var(--radius-pill);
            padding: 5px;
            display: flex;
            border: 1px solid var(--color-border);
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
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

        /* Transaction Cards */
        .trx-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
            overflow: hidden;
            transition: all 0.3s;
        }
        .trx-card:hover { box-shadow: var(--shadow-md); border-color: #cbd5e1; transform: translateY(-2px); }

        .trx-header {
            background: #f8fafc;
            padding: 16px 24px;
            border-bottom: 1px solid var(--color-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .trx-info { flex: 1; }
        .trx-date { font-weight: 600; color: var(--color-text-main); font-size: 0.95rem; }
        .trx-id { color: var(--color-text-light); font-size: 0.85rem; font-family: monospace; letter-spacing: 0.5px; }
        
        .trx-status {
            padding: 6px 14px; border-radius: var(--radius-pill); font-size: 0.85rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .status-lunas { background: #dcfce7; color: #166534; }
        .status-baru { background: #e0f2fe; color: #0284c7; }
        .status-batal { background: #fee2e2; color: #991b1b; }
        .status-proses { background: #fef9c3; color: #854d0e; }

        .trx-delivery {
            font-size: 0.85rem; color: var(--color-text-main); background: #f1f5f9; padding: 6px 12px; border-radius: 8px; font-weight: 600;
        }

        .trx-body { padding: 20px 24px; }
        .trx-item { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px dashed var(--color-border); flex-wrap: wrap; gap: 15px;}
        .trx-item:last-child { border-bottom: none; padding-bottom: 0; }
        .trx-item:first-child { padding-top: 0; }
        
        .item-name { font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 700; color: var(--color-secondary); margin-bottom: 4px; }
        .item-sku { font-size: 0.8rem; color: var(--color-text-light); background: #f1f5f9; padding: 2px 6px; border-radius: 4px; }
        
        .item-price { font-weight: 800; color: var(--color-primary-dark); font-size: 1.1rem; }
        
        .btn-rating {
            background: #fffbeb; color: #d97706; border: 1px solid #fcd34d; padding: 6px 14px; border-radius: var(--radius-pill); font-weight: 600; font-size: 0.85rem; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;
        }
        .btn-rating:hover { background: #fef3c7; color: #b45309; transform: translateY(-1px); }
        .rating-badge { background: #dcfce7; color: #166534; padding: 6px 14px; border-radius: var(--radius-pill); font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 4px; border: 1px solid #bbf7d0;}

        .trx-footer { background: #f8fafc; padding: 16px 24px; border-top: 1px solid var(--color-border); text-align: right; }
        .trx-total-label { color: var(--color-text-light); font-size: 0.95rem; font-weight: 600; margin-right: 15px; }
        .trx-total-price { font-family: 'Outfit', sans-serif; font-size: 1.4rem; font-weight: 800; color: var(--color-primary-dark); }

        /* Empty State */
        .empty-state { text-align: center; padding: 60px 20px; background: var(--color-surface); border-radius: var(--radius-lg); border: 1px dashed #cbd5e1; }
        .empty-state i { font-size: 4rem; color: #cbd5e1; margin-bottom: 20px; }
        .empty-state h3 { color: var(--color-secondary); font-weight: 700; }
        .empty-state p { color: var(--color-text-light); margin-bottom: 24px; }

        /* Custom Footer (Simplified Unified Version) */
        .footer { background: var(--color-surface); border-top: 1px solid var(--color-border); padding: 40px 0 20px; margin-top: auto; }
        .footer-brand .brand-logo { width: 36px; height: 36px; }
        .footer-text { color: var(--color-text-light); font-size: 0.95rem; line-height: 1.6; }
        .social-links { display: flex; gap: 12px; margin-top: 20px; }
        .social-link { width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: var(--color-text-main); font-size: 1.1rem; transition: all 0.3s; }
        .social-link:hover { background: var(--color-primary); color: white; transform: translateY(-3px); }
        .footer-bottom { border-top: 1px solid var(--color-border); margin-top: 30px; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;}
        .footer-bottom p { margin: 0; color: var(--color-text-light); font-size: 0.9rem; }

        /* Pagination */
        .pagination { justify-content: center; margin-top: 25px; }
        .page-link { border: none; color: var(--color-text-main); border-radius: 8px !important; margin: 0 3px; padding: 8px 16px; font-weight: 600; transition: all 0.2s; }
        .page-item.active .page-link { background-color: var(--color-primary); color: white; }
        .page-link:hover:not(.active) { background-color: #f1f5f9; color: var(--color-primary); transform: translateY(-2px); }

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
        
        <ul class="nav-links d-none d-md-flex">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/kategori') }}">Koleksi</a></li>
            <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
        </ul>

        <div class="nav-actions">
            <!-- Keranjang Icon -->
            <a href="{{ route('keranjang') }}" class="action-btn text-decoration-none" title="Keranjang">
                <i class="bi bi-cart3"></i>
            </a>
            <!-- Akun Menu -->
            <a href="{{ route('pembeli.profil') }}" class="action-btn text-decoration-none" title="Akun Saya" style="background: var(--color-primary); color: white; border-color: var(--color-primary); box-shadow: var(--shadow-glow);">
                <i class="bi bi-person-fill"></i>
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-container">

    <div class="page-header">
        <div>
            <h1 class="page-title">Riwayat <span>Pembelian</span></h1>
            <p class="text-muted mt-2 mb-0">Lacak semua transaksi belanja, status pengiriman, dan penilaian Anda.</p>
        </div>
        <a href="{{ route('pembeli.profil') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Profil
        </a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('pembeli.riwayatTransaksi') }}" class="search-container">
        <i class="bi bi-search text-muted ms-3 d-flex align-items-center"></i>
        <input type="text" name="search" class="form-control search-input" placeholder="Cari Riwayat..." value="{{ request('search') }}">
        <button type="submit" class="search-btn">Cari</button>
    </form>

    <!-- Transaksi List -->
    @forelse ($transaksiList as $transaksi)
        @php
            $terdapatDiterima = false;
            $statusPengirimanText = 'Belum ada pengiriman';

            if ($transaksi->penjadwalans) {
              foreach ($transaksi->penjadwalans as $penjadwalan) {
                  if ($penjadwalan && $penjadwalan->pengiriman) {
                      $statusPengirimanText = strtolower(trim($penjadwalan->pengiriman->status_pengiriman));
                      if (in_array($statusPengirimanText, ['diterima', 'sampai'])) {
                          $terdapatDiterima = true;
                          break;
                      }
                  }
              }
          }

          $statusTx = strtolower($transaksi->status_transaksi);
        @endphp

        <div class="trx-card">
            <div class="trx-header">
                <div class="trx-info">
                    <div class="trx-date"><i class="bi bi-calendar-check text-success me-1"></i> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->locale('id')->isoFormat('D MMMM YYYY') }}</div>
                    <div class="trx-id mt-1">ID: {{ $transaksi->id_transaksi }}</div>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="trx-delivery">
                        <i class="bi bi-truck me-1 text-primary"></i> Posisi: <span class="fw-bold">{{ ucfirst($statusPengirimanText) }}</span>
                    </div>

                    <span class="trx-status 
                        {{ $statusTx === 'lunas' ? 'status-lunas' : '' }}
                        {{ $statusTx === 'baru' ? 'status-baru' : '' }}
                        {{ $statusTx === 'batal' ? 'status-batal' : '' }}
                        {{ in_array($statusTx, ['diproses', 'pending']) ? 'status-proses' : '' }}">
                        @if($statusTx === 'lunas') <i class="bi bi-check-circle-fill"></i>
                        @elseif($statusTx === 'baru') <i class="bi bi-record-circle"></i>
                        @elseif($statusTx === 'batal') <i class="bi bi-x-circle-fill"></i>
                        @else <i class="bi bi-hourglass-split"></i>
                        @endif
                        {{ ucfirst($transaksi->status_transaksi) }}
                    </span>
                </div>
            </div>

            <div class="trx-body">
                @foreach ($transaksi->detailTransaksi as $detail)
                    <div class="trx-item">
                        <div>
                            <div class="item-name">{{ $detail->barang->nama_barang ?? 'Barang sudah dihapus' }}</div>
                            <span class="item-sku"><i class="bi bi-tag-fill me-1"></i> {{ strtoupper(substr($detail->barang->nama_barang ?? '-', 0, 1)) . ($detail->barang->id_barang ?? '') }}</span>
                        </div>
                        
                        <div class="d-flex align-items-center gap-4 flex-wrap justify-content-end">
                            <div class="item-price">
                                Rp{{ number_format(($detail->barang->harga_jual ?? $detail->sub_total), 0, ',', '.') }}
                            </div>

                            @if($terdapatDiterima)
                                @php
                                    $existingRating = $detail->barang->ratingDetail ?? null;
                                @endphp

                                @if(!$existingRating)
                                    <a href="{{ route('pembeli.tambahRating', ['id_barang' => $detail->barang->id_barang]) }}" class="btn-rating">
                                        <i class="bi bi-star-fill"></i> Beri Penilaian
                                    </a>
                                @else
                                    <span class="rating-badge">
                                        {{ number_format($existingRating->rating, 1) }} <i class="bi bi-star-fill text-warning"></i> Selesai
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="trx-footer">
                <span class="trx-total-label">Total Belanja</span>
                <span class="trx-total-price">Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</span>
            </div>
        </div>

    @empty
        <div class="empty-state">
            <i class="bi bi-bag-x"></i>
            <h3>Belum Ada Transaksi</h3>
            <p>Sepertinya Anda belum pernah melakukan pembelian apa pun.</p>
            <a href="{{ url('/kategori') }}" class="search-btn text-decoration-none mt-2 d-inline-block">Mulai Belanja</a>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $transaksiList->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
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

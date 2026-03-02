<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .nav-links a::after {
            content: ''; position: absolute; width: 0; height: 2px; bottom: -5px; left: 0;
            background: var(--gradient-primary); transition: width 0.3s ease; border-radius: 2px;
        }
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }

        .nav-actions { display: flex; align-items: center; gap: 12px; }
        .action-btn {
            width: 44px; height: 44px; border-radius: var(--radius-pill); background: var(--color-surface);
            display: flex; align-items: center; justify-content: center; color: var(--color-text-main);
            font-size: 1.2rem; border: 1px solid var(--color-border); transition: all 0.2s ease;
            position: relative;
        }
        .action-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);}
        .action-badge {
            position: absolute; top: -5px; right: -5px; background: var(--color-accent); color: white;
            font-size: 0.7rem; font-weight: 700; width: 20px; height: 20px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; border: 2px solid var(--color-surface);
        }

        /* PAGE SPECIFIC */
        .page-header {
            margin: 40px 0 30px;
        }
        
        .page-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }

        .page-title span { color: var(--color-primary); }

        /* CART LAYOUT */
        .cart-wrapper {
            margin-bottom: 60px;
        }

        .cart-item-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            padding: 20px;
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .cart-item-card:hover {
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .item-image {
            width: 120px;
            height: 120px;
            border-radius: var(--radius-md);
            object-fit: cover;
            background: #f1f5f9;
        }

        .item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .item-title {
            font-size: 1.2rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.2s;
        }

        .item-title:hover {
            color: var(--color-primary);
        }

        .item-desc {
            font-size: 0.9rem;
            color: var(--color-text-light);
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .item-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--color-primary-dark);
            margin: 0;
        }

        .item-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .btn-remove {
            color: #ef4444;
            background: #fef2f2;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-remove:hover {
            background: #ef4444;
            color: white;
        }

        /* SUMMARY SIDEBAR */
        .summary-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            padding: 30px;
            position: sticky;
            top: 100px;
            box-shadow: var(--shadow-md);
        }

        .summary-title {
            font-size: 1.4rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed var(--color-border);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 1rem;
            color: var(--color-text-main);
        }

        .summary-row.total {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--color-primary-dark);
            border-top: 1px dashed var(--color-border);
            padding-top: 15px;
            margin-top: 5px;
        }

        .btn-checkout {
            background: var(--gradient-primary);
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 20px;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px dashed #cbd5e1;
        }

        .empty-cart i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            color: var(--color-secondary);
            font-weight: 700;
        }

        .empty-cart p {
            color: var(--color-text-light);
            margin-bottom: 24px;
        }

        .btn-shop {
            background: var(--color-surface);
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            padding: 10px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-shop:hover {
            background: var(--color-primary);
            color: white;
        }

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

        @media (max-width: 768px) {
            .cart-item-card { flex-direction: column; }
            .item-image { width: 100%; height: 200px; }
            .summary-card { position: static; margin-top: 30px; }
            .nav-links { display: none; } /* Hamburger normally needed here, but keeping simple for cart */
        }
    </style>
</head>
<body>

    <!-- NAVBAR GLASS -->
    <nav class="navbar-glass">
        <div class="container d-flex justify-content-between align-items-center">
            
            <!-- Logo -->
            <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('images/logo2.png') }}" alt="ReUseMart" class="brand-logo">
                <h1 class="brand-text d-none d-sm-block">ReUse<span>Mart</span></h1>
            </a>

            <!-- Center Links -->
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/kategori') }}">Koleksi</a></li>
                <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
            </ul>

            <!-- Right Actions -->
            <div class="nav-actions">
                <a href="{{ route('keranjang') }}" class="action-btn text-decoration-none" title="Keranjang">
                    <i class="bi bi-cart3"></i>
                    @if(count($items) > 0)
                        <span class="action-badge">{{ count($items) }}</span>
                    @endif
                </a>
                <a href="{{ route('diskusi.index') }}" class="action-btn text-decoration-none" title="Pesan">
                    <i class="bi bi-chat-dots"></i>
                </a>
                <a href="{{ route(Auth::guard('penitip')->check() ? 'penitip.profil' : 'pembeli.profil') }}" class="action-btn text-decoration-none" title="Profil Kami">
                    <i class="bi bi-person"></i>
                </a>
            </div>

        </div>
    </nav>

    <!-- CONTENT -->
    <main class="container cart-wrapper">
        <div class="page-header d-flex align-items-start flex-column">
            <h1 class="page-title">Keranjang <span>Anda</span></h1>
            <p class="text-muted mt-2">Daftar barang istimewa yang siap Anda pinang.</p>
        </div>

        <div class="row">
            <!-- CART ITEMS -->
            <div class="col-lg-8">
                @forelse($items as $item)
                    <div class="cart-item-card">
                        <!-- Product Image -->
                        <img src="{{ asset('images/barang/' . ($item->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" alt="{{ $item->nama_barang }}" class="item-image">
                        
                        <!-- Product Info -->
                        <div class="item-details">
                            <div>
                                <a href="{{ url('product/' . $item->id_barang) }}" class="item-title">
                                    {{ $item->nama_barang }}
                                </a>
                                <p class="item-desc">{{ Str::limit($item->deskripsi, 100) }}</p>
                            </div>
                            
                            <div class="item-actions">
                                <p class="item-price">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                                
                                <form action="{{ route('keranjang.hapus', $item->id_barang) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn-remove">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-cart">
                        <i class="bi bi-cart-x"></i>
                        <h3>Keranjang Masih Kosong</h3>
                        <p>Sepertinya Anda belum menambahkan barang ke keranjang.</p>
                        <a href="{{ url('/kategori') }}" class="btn btn-shop">Mulai Belanja</a>
                    </div>
                @endforelse
            </div>

            <!-- SUMMARY SIDEBAR -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h3 class="summary-title">Ringkasan Belanja</h3>
                    
                    @php
                        $subtotal = 0;
                        foreach($items as $i) {
                            $subtotal += $i->harga_jual;
                        }
                    @endphp

                    <div class="summary-row">
                        <span>Total Barang ({{ count($items) }} item)</span>
                        <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row" style="color: var(--color-primary-dark)">
                        <span>Diskon / Potongan</span>
                        <span>- Rp0</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total Tagihan</span>
                        <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    @if(count($items) > 0)
                        <a href="{{ route('checkout') }}" class="btn-checkout text-decoration-none">
                            Lanjut ke Checkout <i class="bi bi-arrow-right fw-bold"></i>
                        </a>
                    @else
                        <button class="btn-checkout" style="opacity: 0.5; cursor: not-allowed;" disabled>
                            Lanjut ke Checkout <i class="bi bi-arrow-right fw-bold"></i>
                        </button>
                    @endif
                    
                    <p class="text-muted text-center mt-3" style="font-size: 0.85rem;">Pembayaran yang aman dan terjamin.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
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
                <div class="d-flex gap-3">
                    <p>Syarat & Ketentuan</p>
                    <p>Kebijakan Privasi</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

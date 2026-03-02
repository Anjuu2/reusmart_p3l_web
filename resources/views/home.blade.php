<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReUseMart | Buy, Sell & Donate Sustainably</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Swiper CSS for modern sliders -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <style>
        :root {
            /* Vibrant Modern Palette */
            --color-primary: #10b981; /* Emerald green */
            --color-primary-dark: #059669;
            --color-secondary: #0f172a; /* Slate 900 for dark texts/elements */
            --color-accent: #f59e0b; /* Amber for highlights/badges */
            --color-bg: #f8fafc; /* Slate 50 background */
            --color-surface: #ffffff;
            --color-text-main: #1e293b;
            --color-text-light: #64748b;
            --color-border: #e2e8f0;
            
            /* Gradients & Shadows */
            --gradient-primary: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-glow: 0 0 20px rgba(16, 185, 129, 0.3);
            
            /* Border Radius */
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-xl: 30px;
            --radius-pill: 9999px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--color-text-main);
            background-color: var(--color-bg);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* -------------------------
           MODERN NAVBAR
        -------------------------- */
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

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: var(--shadow-sm);
        }

        .brand-text {
            font-size: 1.5rem;
            color: var(--color-secondary);
            letter-spacing: -0.5px;
            margin: 0;
        }

        .brand-text span {
            color: var(--color-primary);
        }

        .nav-links {
            display: flex;
            gap: 32px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-links a {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--color-text-light);
            transition: color 0.2s ease;
            position: relative;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--color-secondary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-links a:hover::after, .nav-links a.active::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .action-btn {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-pill);
            background: var(--color-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-text-main);
            font-size: 1.2rem;
            border: 1px solid var(--color-border);
            transition: all 0.2s ease;
            position: relative;
        }

        .action-btn:hover {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--color-accent);
            color: white;
            font-size: 0.7rem;
            font-weight: 800;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid var(--color-surface);
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: var(--radius-pill);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg), var(--shadow-glow);
            color: white;
        }

        /* -------------------------
           HERO BANNER
        -------------------------- */
        .hero-section {
            padding: 24px 0 40px;
        }

        .hero-banner {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            background: var(--color-secondary);
            min-height: 480px;
            display: flex;
            align-items: center;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 60px;
            max-width: 600px;
            color: white;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .hero-title {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
            margin-bottom: 32px;
        }

        /* Swiper for Hero Background */
        .hero-swiper {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-swiper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(15,23,42,0.95) 0%, rgba(15,23,42,0.6) 50%, rgba(15,23,42,0.1) 100%);
            z-index: 2;
        }

        .hero-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* -------------------------
           CATEGORIES WIDGET
        -------------------------- */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
            margin-top: 50px;
        }

        .section-title {
            font-size: 2rem;
            letter-spacing: -0.5px;
            color: var(--color-secondary);
            margin: 0;
        }

        .section-link {
            font-weight: 600;
            color: var(--color-primary);
            display: flex;
            align-items: center;
            gap: 5px;
            transition: gap 0.2s;
        }

        .section-link:hover {
            gap: 8px;
            color: var(--color-primary-dark);
        }

        .category-swiper {
            padding: 10px 5px 30px; /* Space for shadow */
        }

        .category-item {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            padding: 24px 16px;
            text-align: center;
            border: 1px solid var(--color-border);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: block;
            cursor: pointer;
        }

        .category-item:hover {
            transform: translateY(-8px);
            border-color: var(--color-primary);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.1);
        }

        .category-icon-wrapper {
            width: 64px;
            height: 64px;
            background: var(--color-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            transition: transform 0.3s ease;
        }

        .category-item:hover .category-icon-wrapper {
            background: #ecfdf5; /* emerald 50 */
            transform: scale(1.1);
        }

        .category-icon-wrapper img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .category-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--color-secondary);
            margin: 0;
        }

        /* -------------------------
           PRODUCT BROWSING
        -------------------------- */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .product-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .product-media {
            position: relative;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            background: #f1f5f9;
            overflow: hidden;
        }

        .product-media img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-media img {
            transform: scale(1.08);
        }

        .status-tag {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            padding: 6px 12px;
            border-radius: var(--radius-pill);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
            box-shadow: var(--shadow-sm);
        }

        .status-tersedia { color: var(--color-primary); }
        .status-terjual { color: #ef4444; }
        .status-donasi { color: var(--color-accent); }

        .product-details {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-cat-name {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--color-text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--color-border);
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            color: var(--color-primary);
        }

        .btn-add-cart {
            background: #ecfdf5;
            color: var(--color-primary);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: var(--radius-pill);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-add-cart:hover {
            background: var(--color-primary);
            color: white;
            transform: scale(1.1) rotate(-5deg);
        }

        /* -------------------------
           FOOTER
        -------------------------- */
        .modern-footer {
            background: var(--color-secondary);
            color: white;
            padding: 60px 0 24px;
            margin-top: auto;
        }

        .footer-brand .brand-logo {
            filter: brightness(0) invert(1);
        }

        .footer-brand .brand-text {
            color: white;
        }

        .footer-desc {
            color: #94a3b8;
            margin-top: 16px;
            font-size: 0.95rem;
            line-height: 1.6;
            max-width: 300px;
        }

        .footer-title {
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: white;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #94a3b8;
            transition: color 0.2s;
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--color-primary);
            text-decoration: none;
        }

        .social-row {
            display: flex;
            gap: 12px;
        }

        .social-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s;
        }

        .social-circle:hover {
            background: var(--color-primary);
            transform: translateY(-3px);
            color: white;
        }

        .footer-bottom {
            margin-top: 60px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Sweet Custom Toasts */
        .toast-container {
            z-index: 1060;
        }
        .toast {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.5);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .toast-header {
            border-bottom: none;
            padding: 15px 20px 5px;
            background: transparent;
        }
        .toast-body {
            padding: 5px 20px 20px;
            font-size: 0.95rem;
            color: var(--color-text-main);
        }

        /* Responsive Fixes */
        @media (max-width: 991px) {
            .nav-links { display: none; } /* Hide links on tablet/mobile for offcanvas or simpler view */
            .hero-title { font-size: 2.5rem; }
            .hero-content { padding: 40px; }
            .hero-banner { min-height: 400px; }
        }

        @media (max-width: 576px) {
            .hero-content { padding: 30px 20px; text-align: center; }
            .hero-title { font-size: 2rem; }
            .hero-swiper::after {
                background: linear-gradient(to top, rgba(15,23,42,0.95) 0%, rgba(15,23,42,0.4) 100%);
            }
            .section-header { flex-direction: column; align-items: flex-start; gap: 10px; }
            .product-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 16px; }
            .product-media { padding-top: 120%; }
            .product-title { font-size: 0.95rem; }
            .product-price { font-size: 1.1rem; }
            .btn-add-cart { width: 34px; height: 34px; font-size: 1rem; }
            .footer-bottom { flex-direction: column; gap: 10px; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- Transparent Glass Navbar -->
    <nav class="navbar-glass">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                <h1 class="brand-text">ReUse<span>Mart</span></h1>
            </a>

            <ul class="nav-links d-none d-lg-flex">
                <li><a href="{{ url('/') }}" class="active">Beranda</a></li>
                <li><a href="{{ url('/kategori') }}">Koleksi Barang</a></li>
                <li><a href="/about">Tentang Kami</a></li>
            </ul>

            <div class="nav-actions">
                <a href="{{ route('diskusi.index') }}" class="action-btn" title="Diskusi/Pesan">
                    <i class="bi bi-chat-dots"></i>
                </a>
                
                <a href="{{ route('keranjang') }}" class="action-btn" title="Keranjang">
                    <i class="bi bi-bag"></i>
                    <!-- Notifikasi Badge Keranjang jika diperlukan -->
                    <span class="cart-badge">3</span>
                </a>
                
                <div class="dropdown">
                    <a href="#" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 16px; padding: 10px;">
                        @if(Auth::guard('penitip')->check() || Auth::guard('pembeli')->check())
                            <li>
                                <a class="dropdown-item rounded-3 py-2 fw-medium" href="{{ route(Auth::guard('penitip')->check() ? 'penitip.profil' : 'pembeli.profil') }}">
                                    <i class="bi bi-person-circle me-2 text-primary"></i> Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-2"></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="dropdown-item rounded-3 py-2 fw-medium text-danger" onclick="
                                    if(confirm('Yakin ingin keluar?')) {
                                        event.preventDefault();
                                        document.getElementById('logout-form').submit();
                                    }
                                ">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item rounded-3 py-2 fw-medium" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-2 text-primary"></i> Masuk
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-3 py-2 fw-medium" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus me-2 text-success"></i> Daftar
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <!-- Toast Notifications -->
    <div class="toast-container position-fixed top-0 end-0 p-4">
        @if (session('success'))
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-check-circle-fill text-success fs-5 me-2"></i>
                    <strong class="me-auto text-success" style="font-family: 'Outfit', sans-serif; font-size:1.1rem;">Berhasil</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-exclamation-triangle-fill text-warning fs-5 me-2"></i>
                    <strong class="me-auto text-warning" style="font-family: 'Outfit', sans-serif; font-size:1.1rem;">Peringatan</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('warning') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        
        <!-- Hero Section -->
        <section class="container hero-section">
            <div class="hero-banner">
                <!-- Background Swiper -->
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        @foreach($barangs->take(3) as $barang)
                            <div class="swiper-slide">
                                <img src="{{ asset('images/barang/' . ($barang->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" alt="Slide Image">
                            </div>
                        @endforeach
                        <!-- Fallback if there are no items -->
                        @if($barangs->isEmpty())
                            <div class="swiper-slide">
                                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1920" alt="Groceries">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Overlay Content -->
                <div class="hero-content">
                    <span class="hero-badge">Tindakan Nyata</span>
                    <h1 class="hero-title">Kurangi Limbah, Berbagi Manfaat.</h1>
                    <p class="hero-desc">Beli, jual, atau donasikan barang bekas layak pakai dan ubah yang tak terpakai menjadi peluang baru dengan kualitas terjamin.</p>
                    <a href="{{ url('/kategori') }}" class="btn-primary-custom d-inline-block">Mulai Jelajah <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </section>

        <!-- Kategori Section -->
        <section class="container">
            <div class="section-header">
                <h2 class="section-title">Kategori Populer</h2>
                <a href="{{ url('/kategori') }}" class="section-link">Lihat Semua <i class="bi bi-arrow-right"></i></a>
            </div>

            <!-- Swiper Container for Categories -->
            <div class="swiper category-swiper">
                <div class="swiper-wrapper">
                    <!-- Setup Array of Categories to Loop nicely -->
                    @php
                        $categories = [
                            ['id'=>1, 'img'=>'laptop.png', 'name'=>'Elektronik'],
                            ['id'=>2, 'img'=>'baju.png', 'name'=>'Pakaian'],
                            ['id'=>3, 'img'=>'sofa.png', 'name'=>'Perabotan'],
                            ['id'=>4, 'img'=>'tas.png', 'name'=>'Sekolah'],
                            ['id'=>5, 'img'=>'mainan.png', 'name'=>'Hobi'],
                            ['id'=>6, 'img'=>'bayi.png', 'name'=>'Anak'],
                            ['id'=>7, 'img'=>'roda.png', 'name'=>'Otomotif'],
                            ['id'=>8, 'img'=>'tenda.png', 'name'=>'Outdoor'],
                            ['id'=>9, 'img'=>'kantor.png', 'name'=>'Industri'],
                            ['id'=>10, 'img'=>'cermin.png', 'name'=>'Kosmetik'],
                        ];
                    @endphp

                    @foreach($categories as $cat)
                    <div class="swiper-slide">
                        <a href="{{ url('kategori/'.$cat['id']) }}" class="category-item">
                            <div class="category-icon-wrapper">
                                <img src="{{ asset('images/kategori/'.$cat['img']) }}" alt="{{ $cat['name'] }}">
                            </div>
                            <h3 class="category-title">{{ $cat['name'] }}</h3>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Produk Section -->
        <section class="container" style="margin-top: 20px;">
            <div class="section-header">
                <h2 class="section-title">Rekomendasi Terbaru</h2>
                <a href="{{ url('/kategori') }}" class="section-link">Eksplorasi <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="product-grid">
                @foreach($barangs->take(10) as $barang)
                <a href="{{ url('product/' . $barang->id_barang) }}" class="product-card">
                    <div class="product-media">
                        <div class="status-tag 
                            {{ strtolower($barang->status_barang) === 'tersedia' ? 'status-tersedia' : '' }}
                            {{ strtolower($barang->status_barang) === 'terjual' ? 'status-terjual' : '' }}">
                            {{ $barang->status_barang }}
                        </div>
                        <img src="{{ asset('images/barang/' . ($barang->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" alt="{{ $barang->nama_barang }}" loading="lazy">
                    </div>
                    
                    <div class="product-details">
                        <span class="product-cat-name">{{ $barang->kategori->nama_kategori ?? 'Umum' }}</span>
                        <h3 class="product-title">{{ $barang->nama_barang }}</h3>
                        
                        <div class="product-footer">
                            <span class="product-price">Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                            
                            <!-- Beli/Keranjang using object tag trick so the whole card remains clickable -->
                            <object>
                                <form action="{{ route('keranjang.tambah') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="id_barang" value="{{ $barang->id_barang }}">
                                    <button type="submit" class="btn-add-cart" aria-label="Tambahkan ke Keranjang">
                                        <i class="bi bi-basket3-fill"></i>
                                    </button>
                                </form>
                            </object>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        
    </main>

    <!-- Footer -->
    <footer class="modern-footer">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <a href="{{ url('/') }}" class="navbar-brand text-decoration-none">
                            <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                            <h2 class="brand-text d-inline-block m-0 ms-2">ReUse<span>Mart</span></h2>
                        </a>
                        <p class="footer-desc">
                            Platform modern dan berkelanjutan untuk menjual, membeli, dan mendonasikan barang bekas berkualitas. Mari kurangi limbah bersama.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 col-6">
                    <h4 class="footer-title">Jelajahi</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/kategori') }}">Koleksi Terbaru</a></li>
                        <li><a href="#popular">Produk Populer</a></li>
                        <li><a href="#">Cara Jual Barang</a></li>
                        <li><a href="#">Bantu Donasi</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 col-6">
                    <h4 class="footer-title">Perusahaan</h4>
                    <ul class="footer-links">
                        <li><a href="/about">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title">Ikuti Kami</h4>
                    <p class="footer-desc mb-4" style="max-width: 100%;">Dapatkan info terbaru tentang promo, perlindungan konsumen, dan kegiatan komunitas ReUseMart.</p>
                    <div class="social-row">
                        <a href="#" class="social-circle"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-circle"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-circle"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-circle"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} ReUseMart Indonesia. All rights reserved.</span>
                <span>
                    Made with <i class="bi bi-heart-fill text-danger mx-1"></i> for the Environment
                </span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Bootstrap Toasts
            const toastElList = [].slice.call(document.querySelectorAll('.toast'));
            const toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl, { delay: 4000 });
            });
            toastList.forEach(toast => toast.show());

            // Initialize Swiper for Hero
            new Swiper('.hero-swiper', {
                loop: true,
                effect: 'fade',
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 1000,
            });

            // Initialize Swiper for Categories
            new Swiper('.category-swiper', {
                slidesPerView: 2,
                spaceBetween: 15,
                freeMode: true,
                breakpoints: {
                    480: { slidesPerView: 3, spaceBetween: 20 },
                    768: { slidesPerView: 5, spaceBetween: 20 },
                    1024: { slidesPerView: 7, spaceBetween: 24 },
                }
            });

            // Navbar Blur Effect on Scroll
            window.addEventListener('scroll', function() {
                var navbar = document.querySelector('.navbar-glass');
                if (window.scrollY > 50) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.boxShadow = '0 10px 30px rgba(0,0,0,0.05)';
                } else {
                    navbar.style.background = 'rgba(255, 255, 255, 0.85)';
                    navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.03)';
                }
            });
        });
    </script>
</body>
</html>

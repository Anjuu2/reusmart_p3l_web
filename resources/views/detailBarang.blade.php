<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama_barang }} | ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
            --shadow-glow: 0 0 20px rgba(16, 185, 129, 0.3);
            
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        a { text-decoration: none; color: inherit; }

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
        }
        .action-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); transform: translateY(-2px); box-shadow: var(--shadow-glow);}

        /* -------------------------
           PRODUCT LAYOUT
        -------------------------- */
        .product-detail-section {
            padding: 40px 0;
        }

        .product-gallery {
            background: var(--color-surface);
            border-radius: var(--radius-xl);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-border);
            height: 100%;
        }

        .carousel-inner {
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: #f1f5f9;
        }

        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: contain; /* Prevent cropping, keep safe aspect ratio */
            background: #f1f5f9; 
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: var(--color-secondary);
            border-radius: 50%;
            padding: 20px;
        }

        .product-info-panel {
            background: var(--color-surface);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--color-border);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .cat-label {
            display: inline-block;
            background: #e2e8f0;
            color: var(--color-secondary);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 12px;
            border-radius: var(--radius-pill);
            margin-bottom: 16px;
        }

        .product-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin-bottom: 12px;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .rating-box {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--color-border);
        }

        .seller-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #ecfdf5;
            color: var(--color-primary-dark);
            padding: 6px 16px;
            border-radius: var(--radius-pill);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .stars {
            color: var(--color-accent);
            font-size: 1rem;
        }

        .stars span {
            color: var(--color-text-light);
            font-size: 0.9rem;
            margin-left: 4px;
        }

        .product-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--color-primary);
            font-family: 'Outfit', sans-serif;
            margin-bottom: 24px;
        }

        .product-desc {
            color: var(--color-text-light);
            font-size: 1.05rem;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .spec-item {
            background: var(--color-bg);
            padding: 16px;
            border-radius: var(--radius-md);
            border: 1px solid var(--color-border);
        }

        .spec-label {
            font-size: 0.85rem;
            color: var(--color-text-light);
            margin-bottom: 4px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .spec-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--color-secondary);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .status-badge.tersedia { background: #dcfce7; color: #166534; }
        .status-badge.terjual { background: #fee2e2; color: #991b1b; }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: auto;
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            padding: 14px 24px;
            border-radius: var(--radius-pill);
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
        }

        .btn-outline-custom:hover {
            background: #ecfdf5;
            transform: translateY(-2px);
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: var(--radius-pill);
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            box-shadow: var(--shadow-md);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
            color: white;
        }

        /* -------------------------
           RELATED PRODUCTS GRID
        -------------------------- */
        .related-section {
            padding: 60px 0;
            border-top: 1px solid var(--color-border);
        }

        .section-title {
            font-size: 2rem;
            color: var(--color-secondary);
            margin-bottom: 30px;
            letter-spacing: -0.5px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }

        .grid-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .grid-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); border-color: rgba(16, 185, 129, 0.3); }

        .grid-media { position: relative; padding-top: 100%; background: #f1f5f9; overflow: hidden; }
        .grid-media img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .grid-card:hover .grid-media img { transform: scale(1.08); }

        .grid-details { padding: 16px; display: flex; flex-direction: column; flex-grow: 1; }
        .grid-cat { font-size: 0.7rem; font-weight: 700; color: var(--color-text-light); text-transform: uppercase; margin-bottom: 6px; }
        .grid-title { font-size: 1rem; font-weight: 700; color: var(--color-secondary); margin-bottom: 10px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .grid-price { font-size: 1.15rem; font-weight: 800; font-family: 'Outfit', sans-serif; color: var(--color-primary); margin-top: auto;}

        /* Custom Toasts */
        .toast {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .toast-header {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            border-bottom: none;
        }

        /* -------------------------
           FOOTER (Match Home)
        -------------------------- */
        .modern-footer { background: var(--color-secondary); color: white; padding: 60px 0 24px; margin-top: auto; }
        .footer-brand .brand-logo { filter: brightness(0) invert(1); }
        .footer-brand .brand-text { color: white; }
        .footer-desc { color: #94a3b8; margin-top: 16px; font-size: 0.95rem; line-height: 1.6;}
        .footer-title { font-size: 1.1rem; margin-bottom: 20px; color: white; }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #94a3b8; transition: color 0.2s; font-size: 0.95rem; }
        .footer-links a:hover { color: var(--color-primary); text-decoration: none; }
        .social-row { display: flex; gap: 12px; }
        .social-circle { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: white; transition: all 0.3s; }
        .social-circle:hover { background: var(--color-primary); transform: translateY(-3px); color: white; }
        .footer-bottom { margin-top: 60px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; color: #64748b; font-size: 0.85rem; }

        @media (max-width: 991px) {
            .nav-links { display: none; }
            .carousel-item img { height: 400px; }
        }

        @media (max-width: 768px) {
            .product-info-panel { padding: 24px; }
            .product-title { font-size: 1.8rem; }
            .specs-grid { grid-template-columns: 1fr; }
            .action-buttons { grid-template-columns: 1fr; }
            .carousel-item img { height: 300px; }
            .footer-bottom { flex-direction: column; gap: 10px; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- Transparent Glass Navbar -->
    <nav class="navbar-glass">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="{{ url('/') }}" class="navbar-brand text-decoration-none d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                <h1 class="brand-text">ReUse<span>Mart</span></h1>
            </a>

            <ul class="nav-links d-none d-lg-flex">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/kategori') }}">Koleksi Barang</a></li>
                <li><a href="/about">Tentang Kami</a></li>
            </ul>

            <div class="nav-actions">
                <a href="{{ route('diskusi.index') }}" class="action-btn" title="Diskusi/Pesan">
                    <i class="bi bi-chat-dots"></i>
                </a>
                
                <a href="{{ route('keranjang') }}" class="action-btn" title="Keranjang">
                    <i class="bi bi-bag"></i>
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
    <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index: 1055;">
        @if (session('success'))
            <div id="liveToast" class="toast fade" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong class="me-auto">Sukses</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-white fw-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div id="liveToast" class="toast fade" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger text-white">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong class="me-auto">Peringatan</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-white fw-medium">
                    {{ session('warning') }}
                </div>
            </div>
        @endif
    </div>
    
    <!-- Main Content -->
    <main class="flex-grow-1">
        
        <section class="container product-detail-section">
            <div class="row g-4">
                
                <!-- Product Image Gallery (Left) -->
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($product->fotoBarang as $index => $foto)
                                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($product->fotoBarang as $index => $foto)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('images/barang/' . $foto->nama_file) }}" alt="Foto {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Hide controls if there's only 1 image -->
                            @if($product->fotoBarang->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Information (Right) -->
                <div class="col-lg-6">
                    <div class="product-info-panel">
                        <span class="cat-label">{{ $product->kategori->nama_kategori }}</span>
                        
                        <h1 class="product-title">{{ $product->nama_barang }}</h1>
                        
                        <div class="rating-box">
                            <div class="seller-badge">
                                <i class="bi bi-shop"></i> {{ $product->penitip->nama_penitip }}
                            </div>
                            <div class="stars">
                                @if($avgRating > 0)
                                    @php
                                        $rounded = round($avgRating * 2) / 2; 
                                        $fullStars = floor($rounded);
                                        $halfStar  = ($rounded - $fullStars) == 0.5 ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                    @endphp
                                    @for($i = 0; $i < $fullStars; $i++) <i class="fas fa-star"></i> @endfor
                                    @if($halfStar) <i class="fas fa-star-half-alt"></i> @endif
                                    @for($i = 0; $i < $emptyStars; $i++) <i class="far fa-star text-muted"></i> @endfor
                                    <span>({{ number_format($avgRating, 1) }} dari Ulasan)</span>
                                @else
                                    @for($i = 0; $i < 5; $i++) <i class="far fa-star text-muted" style="opacity: 0.5;"></i> @endfor
                                    <span>(Belum ada ulasan)</span>
                                @endif
                            </div>
                        </div>

                        <div class="product-price">
                            Rp{{ number_format($product->harga_jual, 0, ',', '.') }}
                        </div>

                        <p class="product-desc">{{ $product->deskripsi }}</p>

                        <div class="specs-grid">
                            <div class="spec-item">
                                <div class="spec-label">Berat</div>
                                <div class="spec-value">{{ $product->berat }} kg</div>
                            </div>
                            
                            <div class="spec-item">
                                <div class="spec-label">Status Garansi</div>
                                <div class="spec-value">
                                    @if ($garansi_status !== "Garansi Tidak Tersedia")
                                        <span class="text-success"><i class="bi bi-shield-check me-1"></i> Aktif sd {{ \Carbon\Carbon::parse($product->tanggal_garansi)->format('d M y') }}</span>
                                    @else
                                        <span class="text-muted"><i class="bi bi-shield-x me-1"></i> Tidak Berlaku</span>
                                    @endif
                                </div>
                            </div>

                            <div class="spec-item">
                                <div class="spec-label">Ketersediaan</div>
                                <div class="spec-value">
                                    <span class="status-badge {{ strtolower($product->status_barang) === 'tersedia' ? 'tersedia' : 'terjual' }}">
                                        {{ $product->status_barang }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <!-- Add to Cart (Requires POST form) -->
                            <form action="{{ route('keranjang.tambah') }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="id_barang" value="{{ $product->id_barang }}">
                                <button type="submit" class="btn-outline-custom">
                                    <i class="bi bi-bag-plus"></i> Masukkan Keranjang
                                </button>
                            </form>
                            
                            <!-- Buy Now -->
                            <a href="{{ route('checkout') }}" class="btn-primary-custom" style="text-decoration: none;">
                                <i class="bi bi-bag-check"></i> Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Related Products Section -->
        @if($produk_serupa->isNotEmpty())
        <section class="container related-section">
            <h2 class="section-title">Produk Serupa</h2>
            
            <div class="product-grid">
                @foreach($produk_serupa as $item)
                    <a href="{{ url('product/' . $item->id_barang) }}" class="grid-card text-decoration-none">
                        <div class="grid-media">
                            <img src="{{ asset('images/barang/' . ($item->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" alt="{{ $item->nama_barang }}" loading="lazy">
                        </div>
                        <div class="grid-details">
                            <span class="grid-cat">{{ $item->kategori->nama_kategori ?? 'Kategori' }}</span>
                            <h3 class="grid-title">{{ $item->nama_barang }}</h3>
                            <span class="grid-price">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

    </main>

    <!-- Footer -->
    <footer class="modern-footer">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center">
                            <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                            <h2 class="brand-text d-inline-block m-0 ms-2">ReUse<span>Mart</span></h2>
                        </a>
                        <p class="footer-desc">Platform modern berkelanjutan untuk menjual, membeli, dan mendonasikan barang bekas berkualitas.</p>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 col-6">
                    <h4 class="footer-title">Jelajahi</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/kategori') }}">Koleksi Terbaru</a></li>
                        <li><a href="#">Cara Jual Barang</a></li>
                        <li><a href="#">Bantu Donasi</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 col-6">
                    <h4 class="footer-title">Perusahaan</h4>
                    <ul class="footer-links">
                        <li><a href="/about">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title">Ikuti Kami</h4>
                    <p class="footer-desc mb-4">Dapatkan info terbaru tentang promo, perlindungan konsumen, dan kegiatan komunitas.</p>
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
                <span>Made with <i class="bi bi-heart-fill text-danger mx-1"></i> for the Environment</span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Navbar Blur Effect
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

            // Init Toasts
            const toastElList = [].slice.call(document.querySelectorAll('.toast'))
            const toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl, { delay: 4000 });
            })
            toastList.forEach(toast => toast.show());
        });
    </script>
</body>
</html>

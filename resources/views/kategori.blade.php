<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Barang | ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

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
           CATEGORY FILTER BAR (SWIPER)
        -------------------------- */
        .category-filter-section {
            background: var(--color-surface);
            padding: 20px 0;
            border-bottom: 1px solid var(--color-border);
            position: relative;
            z-index: 10;
        }

        .category-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--color-bg);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-pill);
            color: var(--color-text-main);
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
            white-space: nowrap;
            cursor: pointer;
        }

        .category-pill:hover {
            background: #ecfdf5;
            color: var(--color-primary-dark);
            border-color: var(--color-primary);
        }

        .category-pill.active {
            background: var(--color-secondary);
            color: white;
            border-color: var(--color-secondary);
        }

        .category-pill img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }
        
        /* Needs to invert logo colors if pill is active (optional refinement) */
        .category-pill.active img {
            filter: brightness(0) invert(1);
        }

        /* -------------------------
           SEARCH TITLE BAR
        -------------------------- */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }
        
        .page-title span {
            color: var(--color-primary);
        }

        .search-bar {
            position: relative;
            max-width: 400px;
            width: 100%;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border-radius: var(--radius-pill);
            border: 1px solid var(--color-border);
            font-size: 0.95rem;
            background: var(--color-surface);
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .search-bar i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-light);
            font-size: 1.1rem;
        }

        .search-bar button {
            position: absolute;
            right: 6px;
            top: 6px;
            bottom: 6px;
            background: var(--color-primary);
            color: white;
            border: none;
            border-radius: var(--radius-pill);
            padding: 0 16px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .search-bar button:hover {
            background: var(--color-primary-dark);
        }

        /* -------------------------
           PRODUCT GRID (Matches Home exactly)
        -------------------------- */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 80px;
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

        .product-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); border-color: rgba(16, 185, 129, 0.3); }

        .product-media { position: relative; padding-top: 100%; background: #f1f5f9; overflow: hidden; }
        .product-media img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .product-card:hover .product-media img { transform: scale(1.08); }

        .status-tag {
            position: absolute; top: 12px; left: 12px; background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px); padding: 6px 12px; border-radius: var(--radius-pill);
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
            z-index: 2; box-shadow: var(--shadow-sm);
        }
        .status-tersedia { color: var(--color-primary); }
        .status-terjual { color: #ef4444; }

        .product-details { padding: 20px; display: flex; flex-direction: column; flex-grow: 1; }
        .product-cat-name { font-size: 0.75rem; font-weight: 700; color: var(--color-text-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .product-title { font-size: 1.1rem; font-weight: 700; color: var(--color-secondary); margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        .product-footer { margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid var(--color-border); }
        .product-price { font-size: 1.25rem; font-weight: 800; font-family: 'Outfit', sans-serif; color: var(--color-primary); }

        .btn-add-cart {
            background: #ecfdf5; color: var(--color-primary); border: none; width: 40px; height: 40px;
            border-radius: var(--radius-pill); display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; transition: all 0.2s; cursor: pointer;
        }
        .btn-add-cart:hover { background: var(--color-primary); color: white; transform: scale(1.1) rotate(-5deg); }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px dashed var(--color-border);
            grid-column: 1 / -1;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--color-text-light);
            margin-bottom: 20px;
        }

        /* -------------------------
           FOOTER (Match Home & About)
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
        }

        @media (max-width: 576px) {
            .page-header { flex-direction: column; align-items: flex-start; }
            .search-bar { max-width: 100%; }
            .product-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 16px; }
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
            <a href="{{ url('/') }}" class="navbar-brand text-decoration-none d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                <h1 class="brand-text">ReUse<span>Mart</span></h1>
            </a>

            <ul class="nav-links d-none d-lg-flex">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/kategori') }}" class="active">Koleksi Barang</a></li>
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
                                <a class="dropdown-item rounded-3 py-2" href="{{ route(Auth::guard('penitip')->check() ? 'penitip.profil' : 'pembeli.profil') }}">
                                    <i class="bi bi-person-circle me-2 text-primary"></i> Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-2"></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="dropdown-item rounded-3 py-2 text-danger" onclick="
                                    if(confirm('Yakin ingin keluar?')) {
                                        event.preventDefault();
                                        document.getElementById('logout-form').submit();
                                    }
                                ">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                </a>
                            </li>
                        @else
                            <li><a class="dropdown-item rounded-3 py-2" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-2"></i> Masuk</a></li>
                            <li><a class="dropdown-item rounded-3 py-2" href="{{ route('register') }}"><i class="bi bi-person-plus me-2 text-success"></i> Daftar</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Swiper Filter Bar -->
    <section class="category-filter-section">
        <div class="container">
            <div class="swiper filter-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" style="width: auto;">
                        <a href="{{ url('/kategori') }}" class="category-pill {{ !isset($kategori) ? 'active' : '' }}">
                            <i class="bi bi-grid-fill"></i> Semua Kategori
                        </a>
                    </div>
                    
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
                        <div class="swiper-slide" style="width: auto;">
                            <!-- Checking against current category from controller if available -->
                            <a href="{{ url('kategori/'.$cat['id']) }}" class="category-pill {{ (isset($kategori) && $kategori->id_kategori == $cat['id']) ? 'active' : '' }}">
                                <img src="{{ asset('images/kategori/'.$cat['img']) }}" alt="{{ $cat['name'] }}">
                                {{ $cat['name'] }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="flex-grow-1">
        <div class="container">
            
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        @if(isset($kategori))
                            Kategori <span>{{ $kategori->nama_kategori }}</span>
                        @elseif(request('search'))
                            Hasil Pencarian <span>"{{ request('search') }}"</span>
                        @else
                            Seluruh <span>Koleksi</span>
                        @endif
                    </h1>
                    <p class="text-muted mt-2 mb-0">Temukan barang impian dengan harga terbaik dan selamatkan lingkungan.</p>
                </div>

                <div class="search-bar">
                    <form action="{{ route('barang.cari') }}" method="GET" class="m-0">
                        <i class="bi bi-search"></i>
                        <input type="search" name="search" placeholder="Cari barang titipan..." value="{{ request('search') }}">
                        <button type="submit">Cari</button>
                    </form>
                </div>
            </div>

            <!-- Products -->
            <div class="product-grid">
                @if($produk->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-search"></i>
                        <h3>Tidak Ada Produk Ditemukan</h3>
                        <p class="text-muted">Cobalah menyesuaikan kata kunci pencarian Anda atau cek kategori lainnya.</p>
                        <a href="{{ url('/kategori') }}" class="btn btn-outline-success mt-3 rounded-pill px-4 fw-medium">Lihat Semua Produk</a>
                    </div>
                @else
                    @foreach($produk as $item)
                        <a href="{{ url('product/' . $item->id_barang) }}" class="product-card">
                            <div class="product-media">
                                <div class="status-tag 
                                    {{ strtolower($item->status_barang) === 'tersedia' ? 'status-tersedia' : '' }}
                                    {{ strtolower($item->status_barang) === 'terjual' ? 'status-terjual' : '' }}">
                                    {{ $item->status_barang }}
                                </div>
                                <img src="{{ asset('images/barang/' . ($item->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" alt="{{ $item->nama_barang }}" loading="lazy">
                            </div>
                            
                            <div class="product-details">
                                <span class="product-cat-name">{{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                                <h3 class="product-title">{{ $item->nama_barang }}</h3>
                                
                                <div class="product-footer">
                                    <span class="product-price">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                                    
                                    <object>
                                        <form action="{{ route('keranjang.tambah') }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <input type="hidden" name="id_barang" value="{{ $item->id_barang }}">
                                            <button type="submit" class="btn-add-cart" aria-label="Tambahkan ke Keranjang">
                                                <i class="bi bi-basket3-fill"></i>
                                            </button>
                                        </form>
                                    </object>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>

        </div>
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
                        <li><a href="{{ url('/kategori') }}" class="text-primary">Koleksi Terbaru</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

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

            // Swiper for Category Pills
            new Swiper('.filter-swiper', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                freeMode: true,
                mousewheel: {
                    forceToAxis: true,
                },
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | ReUseMart</title>

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
        }

        .brand-logo { width: 42px; height: 42px; border-radius: 12px; }
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

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .action-btn {
            width: 44px; height: 44px; border-radius: var(--radius-pill); background: var(--color-surface);
            display: flex; align-items: center; justify-content: center; color: var(--color-text-main);
            font-size: 1.2rem; border: 1px solid var(--color-border); transition: all 0.2s ease;
        }
        .action-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); transform: translateY(-2px); }

        /* -------------------------
           ABOUT SECION
        -------------------------- */
        .about-header {
            position: relative;
            background: var(--color-secondary);
            border-radius: var(--radius-xl);
            overflow: hidden;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 24px;
        }

        .about-header::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to top, rgba(15,23,42,0.95), rgba(15,23,42,0.5));
            z-index: 1;
        }

        .about-header img {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
        }

        .header-content {
            position: relative;
            z-index: 2;
            color: white;
            padding: 40px;
            max-width: 800px;
        }

        .header-content h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .header-content p {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
        }

        .info-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--color-border);
            height: 100%;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: #ecfdf5;
            color: var(--color-primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 24px;
        }

        .info-card h2 {
            font-size: 1.8rem;
            color: var(--color-secondary);
            margin-bottom: 16px;
        }

        .info-card p, .info-card li {
            color: var(--color-text-light);
            line-height: 1.7;
            font-size: 1.05rem;
        }

        .custom-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .custom-list li {
            position: relative;
            padding-left: 32px;
            margin-bottom: 16px;
        }

        .custom-list li::before {
            content: '\F633'; /* Bootstrap check-circle-fill icon */
            font-family: "bootstrap-icons";
            position: absolute;
            left: 0;
            top: 2px;
            color: var(--color-primary);
            font-size: 1.2rem;
        }

        /* Values Grid */
        .value-box {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            padding: 30px;
            text-align: center;
            border: 1px solid var(--color-border);
            height: 100%;
            transition: all 0.3s;
        }

        .value-box:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-md);
            border-color: var(--color-primary);
        }

        .value-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 20px;
        }

        .value-box h3 {
            font-size: 1.2rem;
            color: var(--color-secondary);
            margin-bottom: 12px;
        }

        .value-box p {
            color: var(--color-text-light);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Contact Section */
        .contact-section {
            background: var(--gradient-primary);
            border-radius: var(--radius-xl);
            padding: 60px 40px;
            color: white;
            text-align: center;
            margin: 60px 0;
        }

        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .contact-section a {
            font-weight: 700;
            border-bottom: 2px solid rgba(255,255,255,0.3);
            padding-bottom: 2px;
            transition: all 0.2s;
        }

        .contact-section a:hover {
            border-color: white;
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
            .header-content h1 { font-size: 2.5rem; }
            .about-header { min-height: 300px; }
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
                <li><a href="/about" class="active">Tentang Kami</a></li>
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

    <!-- Main Content -->
    <main class="flex-grow-1">
        
        <div class="container">
            <!-- Hero Banner -->
            <section class="about-header">
                <img src="{{ asset('images/barang/reusemart.jpg') }}" alt="ReUseMart Banner">
                <div class="header-content">
                    <h1>Mengenal ReUseMart</h1>
                    <p>Platform e-commerce berkelanjutan pertama untuk mengubah barang tak terpakai menjadi manfaat bagi semua orang.</p>
                </div>
            </section>

            <!-- Visi & Misi Row -->
            <section class="row g-4 mt-2">
                <div class="col-lg-5">
                    <div class="info-card">
                        <div class="card-icon"><i class="bi bi-eye"></i></div>
                        <h2>Visi Kami</h2>
                        <p>Menjadi platform e-commerce terkemuka yang mendorong keberlanjutan dan pengurangan sampah dengan menyediakan ruang aman untuk membeli, menjual, dan mendonasikan barang bekas berkualitas tinggi di Asia.</p>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="info-card">
                        <div class="card-icon"><i class="bi bi-bullseye"></i></div>
                        <h2>Misi Kami</h2>
                        <p class="mb-4">Hadir untuk menciptakan pasar ekonomi sirkular. Kami mengurangi limbah dengan cara-cara berikut:</p>
                        <ul class="custom-list">
                            <li><strong>Meningkatkan Aksesibilitas:</strong> Memberikan pengalaman berbelanja yang mudah, nyaman, dan terpercaya.</li>
                            <li><strong>Mendorong Keberlanjutan:</strong> Mengurangi limbah dengan memberikan barang bekas kesempatan kedua.</li>
                            <li><strong>Memberdayakan Komunitas:</strong> Membantu individu mendapat akses barang murah dan ruang untuk berbisnis kecil-kecilan.</li>
                            <li><strong>Edukasi Konsumen:</strong> Menyebarkan kesadaran lingkungan lewat perdagangan cerdas.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Values Section -->
            <section class="mt-5 mb-5">
                <div class="text-center mb-5">
                    <h2 class="display-6" style="font-family: 'Outfit', sans-serif; font-weight:700; color:var(--color-secondary);">Nilai Inti Kami</h2>
                    <p class="text-muted">Prinsip dasar yang menggerakkan setiap inovasi ReUseMart</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="value-box">
                            <div class="value-icon"><i class="bi bi-tree"></i></div>
                            <h3>Keberlanjutan</h3>
                            <p>Berkomitmen untuk mengurangi dampak lingkungan melalui perdagangan sirkular dan penggunaan ulang sumber daya bumi.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-box">
                            <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                            <h3>Kualitas Terjamin</h3>
                            <p>Melalui pemeriksaan dan kurasi ketat, kami pastikan hanya barang bekas berkualitas tinggi yang sampai ke tangan pembeli.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-box">
                            <div class="value-icon"><i class="bi bi-search"></i></div>
                            <h3>Transparansi Total</h3>
                            <p>Kepercayaan adalah dasar. Informasi kondisi barang, transaksi, dan riwayat sepenuhnya terbuka dan jelas bagi semua pihak.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-box">
                            <div class="value-icon"><i class="bi bi-lightbulb"></i></div>
                            <h3>Inovasi</h3>
                            <p>Kami terus mengembangkan fitur pintar untuk mempermudah proses transaksi dan menjamin kenyamanan pengguna.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-box">
                            <div class="value-icon"><i class="bi bi-heart"></i></div>
                            <h3>Memberdayakan</h3>
                            <p>Akses harga terjangkau membantu ekonomi masyarakat dan mendukung kehidupan yang lebih stabil dan sejahtera.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-box">
                            <div class="value-icon"><i class="bi bi-people"></i></div>
                            <h3>Komunitas Inklusif</h3>
                            <p>Pemberdayaan sosial dengan menghubungkan pembeli dan penjual di ruang yang aman dan nyaman untuk semua kalangan.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Clean Contact Banner -->
            <section class="contact-section">
                <i class="bi bi-headset contact-icon"></i>
                <h2 class="mb-3">Selalu Siap Membantu Anda</h2>
                <p class="mb-4 fs-5" style="color: rgba(255,255,255,0.8);">Jika Anda memiliki pertanyaan, butuh bantuan fitur, atau ingin beriklan, jangan ragu untuk menghubungi tim kami.</p>
                <div class="d-flex justify-content-center gap-4 flex-wrap">
                    <div class="fs-5"><i class="bi bi-envelope-fill me-2"></i> <a href="mailto:support@reusemart.com" class="text-white">support@reusemart.com</a></div>
                    <div class="fs-5"><i class="bi bi-telephone-fill me-2"></i> <a href="tel:+11234567890" class="text-white">+1 (123) 456-7890</a></div>
                </div>
            </section>

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
                        <li><a href="{{ url('/kategori') }}">Koleksi Terbaru</a></li>
                        <li><a href="#">Cara Jual Barang</a></li>
                        <li><a href="#">Bantu Donasi</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 col-6">
                    <h4 class="footer-title">Perusahaan</h4>
                    <ul class="footer-links">
                        <li><a href="/about" class="text-primary">Tentang Kami</a></li>
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
        });
    </script>
</body>
</html>

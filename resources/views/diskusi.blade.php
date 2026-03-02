<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Diskusi | ReUseMart</title>

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
        }
        .action-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);}

        /* PAGE SPECIFIC */
        .page-header {
            margin: 40px 0 30px;
            text-align: center;
        }
        
        .page-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }

        .page-title span { color: var(--color-primary); }

        .discussion-wrapper {
            max-width: 800px;
            margin: 0 auto 60px;
        }

        /* DISCUSSION CARDS */
        .discussion-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .discussion-card:hover {
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        /* Question Bubble */
        .q-bubble {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .avatar-q {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #f1f5f9;
            color: var(--color-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .q-content {
            background: #f8fafc;
            border: 1px solid var(--color-border);
            padding: 16px;
            border-radius: 0 var(--radius-md) var(--radius-md) var(--radius-md);
            flex: 1;
        }

        .q-label {
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: 4px;
            font-size: 0.95rem;
        }

        .q-text {
            color: var(--color-text-main);
            margin: 0;
            line-height: 1.5;
            font-size: 1rem;
        }

        /* Answer Bubble */
        .a-bubble {
            display: flex;
            gap: 16px;
            margin-left: 40px; /* Indent answer */
        }

        .avatar-a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ecfdf5;
            color: var(--color-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .a-content {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            padding: 16px;
            border-radius: var(--radius-md) var(--radius-md) var(--radius-md) 0;
            flex: 1;
        }

        .a-label {
            font-weight: 700;
            color: var(--color-primary-dark);
            margin-bottom: 4px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .a-text {
            color: var(--color-primary-dark);
            margin: 0;
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .unanswered {
            margin-left: 40px;
            padding: 12px 16px;
            background: #fffbeb;
            border: 1px dashed #fcd34d;
            border-radius: var(--radius-md);
            color: #b45309;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Empty State */
        .empty-discussion {
            text-align: center;
            padding: 60px 20px;
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px dashed #cbd5e1;
        }

        .empty-discussion i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .empty-discussion h3 {
            color: var(--color-secondary);
            font-weight: 700;
        }

        .empty-discussion p {
            color: var(--color-text-light);
            margin-bottom: 0;
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
            .nav-links { display: none; }
            .a-bubble, .unanswered { margin-left: 20px; }
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
                </a>
                <a href="{{ route('diskusi.index') }}" class="action-btn text-decoration-none" title="Pesan" style="background: var(--color-primary); color: white; border-color: var(--color-primary); box-shadow: var(--shadow-glow);">
                    <i class="bi bi-chat-dots-fill"></i>
                </a>
                <a href="{{ route(Auth::guard('penitip')->check() ? 'penitip.profil' : 'pembeli.profil') }}" class="action-btn text-decoration-none" title="Profil Kami">
                    <i class="bi bi-person"></i>
                </a>
            </div>

        </div>
    </nav>

    <!-- CONTENT -->
    <main class="container discussion-wrapper">
        <div class="page-header">
            <h1 class="page-title">Ruang <span>Diskusi</span></h1>
            <p class="text-muted mt-2">Pusat tanya jawab seputar produk antara calon pembeli dan admin.</p>
        </div>

        <div class="discussion-list">
            @forelse ($diskusi as $d)
                <div class="discussion-card">
                    <!-- Pertanyaan -->
                    <div class="q-bubble">
                        <div class="avatar-q">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="q-content">
                            <div class="q-label">Calon Pembeli</div>
                            <p class="q-text">{{ $d->pertanyaan }}</p>
                        </div>
                    </div>

                    <!-- Jawaban / Status -->
                    @if ($d->jawaban)
                        <div class="a-bubble">
                            <div class="avatar-a">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div class="a-content">
                                <div class="a-label">
                                    Admin ReUseMart <i class="bi bi-patch-check-fill ms-1" title="Verified"></i>
                                </div>
                                <p class="a-text">{{ $d->jawaban }}</p>
                            </div>
                        </div>
                    @else
                        <div class="unanswered">
                            <i class="bi bi-hourglass-split"></i> Pertanyaan sedang menunggu balasan dari Admin.
                        </div>
                    @endif
                </div>
            @empty
                <div class="empty-discussion">
                    <i class="bi bi-chat-square-text"></i>
                    <h3>Belum Ada Diskusi</h3>
                    <p>Produk ini belum memiliki pertanyaan atau diskusi apa pun.</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row pt-2 pb-4">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

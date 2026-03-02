<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | ReUseMart</title>

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

        /* HEADER & NAVBAR */
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
        }
        .page-title {
            font-size: 2.2rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }
        .page-title span { color: var(--color-primary); }

        .checkout-wrapper { margin-bottom: 60px; }

        /* CARDS */
        .co-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .co-card:hover {
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .co-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--color-border);
            padding-bottom: 16px;
            margin-bottom: 16px;
        }

        .co-card-title {
            font-size: 1.1rem;
            color: var(--color-secondary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .co-card-title i {
            color: var(--color-primary);
            font-size: 1.3rem;
        }

        .btn-outline-custom {
            border: 1px solid var(--color-primary);
            color: var(--color-primary-dark);
            background: #f1fdfaa6;
            padding: 6px 16px;
            border-radius: var(--radius-pill);
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .btn-outline-custom:hover {
            background: var(--color-primary);
            color: white;
        }

        /* TEXT CONTENT */
        .text-address { font-size: 1rem; color: var(--color-text-main); font-weight: 500; margin-bottom: 8px; line-height: 1.5;}
        .text-address-detail { font-size: 0.9rem; color: var(--color-text-light); }

        /* PRODUCT ROW */
        .product-list-item {
            display: flex;
            gap: 20px;
            padding: 16px 0;
            border-bottom: 1px dashed var(--color-border);
        }
        .product-list-item:last-child { border-bottom: none; padding-bottom: 0; }
        
        .product-list-image {
            width: 80px; height: 80px; border-radius: var(--radius-md); object-fit: cover; border: 1px solid var(--color-border); background: #f8fafc;
        }

        .product-list-info { flex: 1; }
        .product-list-name { font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 700; color: var(--color-text-main); margin-bottom: 6px; }
        .product-list-desc { font-size: 0.85rem; color: var(--color-text-light); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 8px;}
        .product-list-price { font-size: 1.1rem; font-weight: 800; color: var(--color-primary-dark); margin: 0; }

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

        .form-control {
            border-radius: var(--radius-md);
            padding: 12px 16px;
            border: 1px solid var(--color-border);
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .summary-row {
            display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; color: var(--color-text-light);
            font-weight: 500;
        }
        .summary-row.total {
            font-size: 1.3rem; font-weight: 800; color: var(--color-primary-dark);
            border-top: 1px dashed var(--color-border);
            padding-top: 16px; margin-top: 16px; margin-bottom: 0;
        }

        .btn-pay {
            background: var(--gradient-primary);
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 24px;
            transition: all 0.3s ease;
            display: flex; justify-content: center; align-items: center; gap: 8px;
        }
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            color: white;
        }

        /* MODALS */
        .modal-content {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }
        .modal-header {
            background: var(--color-bg);
            border-bottom: 1px solid var(--color-border);
            padding: 24px;
        }
        .modal-title { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); display: flex; align-items: center; gap: 10px; }
        .modal-body { padding: 30px 24px; background: #fff; }

        .address-card, .shipping-card {
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            padding: 16px;
            margin-bottom: 16px;
            transition: all 0.2s;
            cursor: pointer;
        }
        .address-card:hover, .shipping-card:hover {
            border-color: var(--color-primary);
            background: #f1fdfaa6;
        }
        .address-card.selected, .shipping-card.selected {
            border: 2px solid var(--color-primary);
            background: #ecfdf5;
        }

        /* CUSTOM FOOTER */
        .footer {
            background: var(--color-surface);
            border-top: 1px solid var(--color-border);
            padding: 40px 0 20px;
            margin-top: auto;
        }
        .footer-brand .brand-logo { width: 36px; height: 36px; }
        .footer-text { color: var(--color-text-light); font-size: 0.95rem; line-height: 1.6; }
        .footer-bottom { border-top: 1px solid var(--color-border); margin-top: 30px; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;}
        .footer-bottom p { margin: 0; color: var(--color-text-light); font-size: 0.9rem; }

    </style>
</head>
<body>

    <!-- NAVBAR GLASS -->
    <nav class="navbar-glass">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('images/logo2.png') }}" alt="ReUseMart" class="brand-logo">
                <h1 class="brand-text d-none d-sm-block">ReUse<span>Mart</span></h1>
            </a>

            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/kategori') }}">Koleksi</a></li>
                <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
            </ul>

            <div class="nav-actions">
                <a href="{{ route('keranjang') }}" class="action-btn text-decoration-none" title="Keranjang">
                    <i class="bi bi-cart3"></i>
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
    <main class="container checkout-wrapper">
        <div class="page-header d-flex align-items-start flex-column">
            <h1 class="page-title">Checkout <span>Pesanan</span></h1>
            <p class="text-muted mt-2">Pastikan alamat dan rincian pesanan Anda sudah benar.</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger bg-danger text-white border-0 rounded-3 mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            </div>
        @endif

        @php
            $alamatPertama = $alamatList->first();
        @endphp

        <div class="row">
            <!-- KIRI: Detail Checkout -->
            <div class="col-lg-8">
                
                {{-- Alamat Pengiriman --}}
                <div class="co-card">
                    <div class="co-card-header">
                        <h4 class="co-card-title"><i class="bi bi-geo-alt-fill"></i> Alamat Pengiriman</h4>
                        <button class="btn-outline-custom" data-bs-toggle="modal" data-bs-target="#gantiAlamatModal">
                            Ubah Alamat
                        </button>
                    </div>
                    <div id="alamatUtama">
                        <p class="text-address mb-1">
                            {{ $alamatPertama->jalan }}, {{ $alamatPertama->kelurahan }}, {{ $alamatPertama->kecamatan }}, <br>
                            {{ $alamatPertama->kota }}, {{ $alamatPertama->provinsi }} - {{ $alamatPertama->kode_pos }}
                        </p>
                        <p class="text-address-detail"><i class="bi bi-card-text me-1"></i> Detail: {{ $alamatPertama->detail }}</p>
                    </div>
                </div>

                {{-- Jenis Pengiriman --}}
                <div class="co-card">
                    <div class="co-card-header">
                        <h4 class="co-card-title"><i class="bi bi-truck"></i> Opsi Pengiriman</h4>
                        <button class="btn-outline-custom" data-bs-toggle="modal" data-bs-target="#gantiPengirimanModal">
                            Ubah Pengiriman
                        </button>
                    </div>
                    <div id="jenisPengirimanTerpilih" class="d-flex align-items-center gap-2">
                        <i class="bi bi-box-seam fs-4 text-primary"></i> <span class="fw-bold fs-5">Kurir</span>
                    </div>
                    <input type="hidden" id="inputJenisPengiriman" value="Kurir">
                </div>

                {{-- Produk --}}
                <div class="co-card">
                    <div class="co-card-header">
                        <h4 class="co-card-title"><i class="bi bi-bag-check-fill"></i> Rincian Barang</h4>
                    </div>
                    
                    <div class="product-list">
                        @foreach ($items as $item)
                        <div class="product-list-item">
                            <img src="{{ asset('images/barang/' . ($item->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" alt="{{ $item->nama_barang }}" class="product-list-image">
                            <div class="product-list-info">
                                <h5 class="product-list-name">{{ $item->nama_barang }}</h5>
                                <p class="product-list-desc">{{ $item->deskripsi }}</p>
                                <p class="product-list-price">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- KANAN: Informasi Poin & Total Pembayaran -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="fw-bold mb-3 font-outfit" style="color: var(--color-secondary);"><i class="bi bi-star-fill text-warning me-2"></i>Tukar Poin ReUseMart</h5>
                    
                    <div class="p-3 mb-4 rounded-3" style="background: #fdfae5; border: 1px dashed #fcd34d;">
                        <p class="mb-1 text-dark fs-6">Poin Anda saat ini:</p>
                        <h3 class="fw-bold text-warning m-0 mb-2" id="totalPoin">{{$poin}} PTS</h3>
                        <p class="text-muted m-0" style="font-size: 0.8rem;">(100 Poin = Potongan Rp10.000)</p>
                    </div>

                    <div class="mb-4">
                        <label for="poinInput" class="form-label fw-bold text-dark fs-6 mb-2">Tukar Poin Pembeli</label>
                        <input type="number" class="form-control form-control-lg" id="poinInput" placeholder="0" min="0" max="300" style="font-weight: 700;">
                        <div id="poinError" class="text-danger mt-2" style="display: none; font-size: 0.85rem; font-weight:600;">
                            <i class="bi bi-x-circle me-1"></i>Poin melebihi saldo.
                        </div>
                    </div>

                    <hr class="mb-4 text-muted" style="border-style: dashed;">

                    <h5 class="fw-bold mb-3 font-outfit" style="color: var(--color-secondary);"><i class="bi bi-receipt me-2"></i>Ringkasan Transaksi</h5>
                    
                    <div class="summary-row">
                        <span>Total Harga Barang</span>
                        <span class="text-dark fw-bold" id="subtotalDisplay">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        <input type="hidden" id="subtotalHidden" value="{{ $subtotal }}">
                    </div>
                    
                    <div class="summary-row">
                        <span>Ongkos Kirim</span>
                        <span class="text-dark fw-bold" id="ongkirDisplay">Rp0</span>
                    </div>

                    <div class="summary-row" style="color: var(--color-primary-dark);">
                        <span>Diskon (Poin)</span>
                        <span class="fw-bold" id="potonganPoin">-Rp0</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total Tagihan</span>
                        <span id="totalBayar">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <form method="POST" action="{{ route('checkout.submit') }}" class="mt-4">
                        @csrf
                        <input type="hidden" name="total_pembayaran" id="totalPembayaranInput" value="{{ $subtotal }}">
                        <input type="hidden" name="jenis_pengiriman" id="inputJenisPengirimanForm" value="Kurir">
                        <input type="hidden" name="poin_tukar" id="inputPoinTukar" value="0">
                        <input type="hidden" name="id_alamat" id="inputIdAlamat" value="{{ $alamatPertama->id_alamat_pembeli }}">
                        
                        <button type="submit" class="btn-pay">
                            Bayar Sekarang <i class="bi bi-shield-lock"></i>
                        </button>
                    </form>
                    
                    <p class="text-center text-muted mt-3" style="font-size: 0.8rem;">
                        Dengan melanjutkan pembayaran, Anda menyetujui <br><a href="#" class="text-decoration-none text-primary">Syarat & Ketentuan</a> ReUseMart.
                    </p>
                </div>
            </div>
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
                    <p class="footer-text">Platform terpercaya untuk jual beli dan donasi barang bekas berkualitas. Mari ciptakan lingkungan yang lebih aman dan berkelanjutan menggunakan ReUseMart.</p>
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

    <!-- MODAL GANTI ALAMAT -->
    <div class="modal fade" id="gantiAlamatModal" tabindex="-1" aria-labelledby="gantiAlamatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-geo-alt-fill text-primary"></i> Pilih Alamat Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="row">
                        @foreach ($alamatList as $alamat)
                            <div class="col-12">
                                <div class="address-card bg-white" 
                                    onclick="gunakanAlamatDariCard(this)"
                                    data-id="{{ $alamat->id_alamat }}"
                                    data-jalan="{{ $alamat->jalan }}"
                                    data-kelurahan="{{ $alamat->kelurahan }}"
                                    data-kecamatan="{{ $alamat->kecamatan }}"
                                    data-kota="{{ $alamat->kota }}"
                                    data-provinsi="{{ $alamat->provinsi }}"
                                    data-kodepos="{{ $alamat->kode_pos }}"
                                    data-detail="{{ $alamat->detail }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-2 text-dark">{{ $alamat->jalan }}</h6>
                                            <p class="mb-2 text-muted" style="font-size:0.95rem;">
                                                {{ $alamat->kelurahan }}, {{ $alamat->kecamatan }}, <br>
                                                {{ $alamat->kota }}, {{ $alamat->provinsi }} - {{ $alamat->kode_pos }}
                                            </p>
                                            <p class="mb-0 text-muted" style="font-size:0.85rem;"><i class="bi bi-info-circle me-1"></i> Detail: {{ $alamat->detail }}</p>
                                        </div>
                                        <div>
                                            <button class="btn btn-outline-success btn-sm rounded-pill px-3 fw-bold align-items-center d-flex gap-1"><i class="bi bi-check2"></i> Pilih</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL GANTI PENGIRIMAN -->
    <div class="modal fade" id="gantiPengirimanModal" tabindex="-1" aria-labelledby="gantiPengirimanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-truck text-primary"></i> Metode Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body bg-light">
                    
                    {{-- Opsi: Kurir --}}
                    <div class="shipping-card bg-white" onclick="pilihPengiriman('Kurir', this)">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-box-seam fs-3 text-primary"></i>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Jasa Kurir ReUseMart</h6>
                                    <p class="mb-0 text-muted" style="font-size:0.85rem;">Pengiriman area Yogyakarta & sekitarnya.</p>
                                </div>
                            </div>
                            <div class="shipping-radio">
                                <i class="bi bi-circle text-muted fs-4 select-icon"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Opsi: Ambil Sendiri --}}
                    <div class="shipping-card bg-white mt-3" onclick="pilihPengiriman('Ambil Sendiri', this)">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-shop fs-3 text-success"></i>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Ambil Sendiri</h6>
                                    <p class="mb-0 text-muted" style="font-size:0.85rem;">Ambil langsung di Gudang kami (Maks. 3 Hari).</p>
                                </div>
                            </div>
                            <div class="shipping-radio">
                                <i class="bi bi-circle text-muted fs-4 select-icon"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // LOGIC SCRIPTS FROM ORIGINAL FILE
        document.addEventListener('DOMContentLoaded', function () {
            const poinInput     = document.getElementById('poinInput');
            const totalPoin     = parseInt(document.getElementById('totalPoin').innerText) || 0;
            const poinError     = document.getElementById('poinError');
            const potonganPoin  = document.getElementById('potonganPoin');
            const totalBayar    = document.getElementById('totalBayar');
            const subtotalHidden = document.getElementById('subtotalHidden');
            const ongkirDisplay  = document.getElementById('ongkirDisplay');
            
            const inputPoinTukar        = document.getElementById('inputPoinTukar');
            const totalPembayaranInput  = document.getElementById('totalPembayaranInput');

            function updateTotal() {
                let subtotal = parseInt(subtotalHidden.value) || 0;
                let poinAmount = parseInt(poinInput.value) || 0;
                
                // Ambil string ongkir "Rp10.000" dan hapus karakter non-angka
                let textOngkir = ongkirDisplay.innerText;
                let nominalOngkir = parseInt(textOngkir.replace(/\D/g, '')) || 0;

                let maxPoinDiizinkan = 300;
                
                // Max points constraint
                if (poinAmount > maxPoinDiizinkan) { poinAmount = maxPoinDiizinkan; poinInput.value = poinAmount; }
                if (poinAmount < 0) { poinAmount = 0; poinInput.value = poinAmount; }

                if (poinAmount > totalPoin) {
                    poinError.style.display = 'block';
                    poinAmount = 0;
                } else {
                    poinError.style.display = 'none';
                }

                // Kalkulasi 1 poin = Rp10.000 (Sesuai original requirement) -> Wait, original code says: 100 poin = Rp10.000
                // IF 100 POIN = Rp10.000, THEN 1 poin = Rp100
                let diskon = poinAmount * 100;
                let totalTagihan = subtotal + nominalOngkir - diskon;

                potonganPoin.innerText = "-Rp" + diskon.toLocaleString('id-ID');
                totalBayar.innerText = "Rp" + totalTagihan.toLocaleString('id-ID');

                // Update hidden inputs
                inputPoinTukar.value = poinAmount;
                totalPembayaranInput.value = totalTagihan;
            }

            poinInput.addEventListener('input', updateTotal);
            
            // Panggil pada saat pertama load
            updateTotal();
        });

        const myGantiAlamatModal = new bootstrap.Modal(document.getElementById('gantiAlamatModal'));
        function gunakanAlamatDariCard(element) {
            let idAttr = element.getAttribute('data-id');
            let j   = element.getAttribute('data-jalan');
            let kl  = element.getAttribute('data-kelurahan');
            let kc  = element.getAttribute('data-kecamatan');
            let kt  = element.getAttribute('data-kota');
            let p   = element.getAttribute('data-provinsi');
            let kp  = element.getAttribute('data-kodepos');
            let d   = element.getAttribute('data-detail');

            let htmlBaru = `
                <p class="text-address mb-1">
                    ${j}, ${kl}, ${kc}, <br>
                    ${kt}, ${p} - ${kp}
                </p>
                <p class="text-address-detail"><i class="bi bi-card-text me-1"></i> Detail: ${d}</p>
            `;
            
            document.getElementById('alamatUtama').innerHTML = htmlBaru;
            document.getElementById('inputIdAlamat').value = idAttr; // Set id address hidden input

            myGantiAlamatModal.hide();
        }

        const myGantiPengirimanModal = new bootstrap.Modal(document.getElementById('gantiPengirimanModal'));
        function pilihPengiriman(jenis, element) {
            let label = jenis;
            let iconText = '';
            
            if (jenis === 'Kurir') {
                iconText = '<i class="bi bi-box-seam fs-4 text-primary"></i> <span class="fw-bold fs-5">Kurir</span>';
                document.getElementById('ongkirDisplay').innerText = "Rp20.000"; // Contoh static sesuai implementasi asli jika ada? Asli set Rp0
                // Wait! Asli didn't set nominal ongkir to JS when changing. Setting Rp0 to be safe
                document.getElementById('ongkirDisplay').innerText = "Rp0";
            } else {
                iconText = '<i class="bi bi-shop fs-4 text-success"></i> <span class="fw-bold fs-5">Ambil Sendiri</span>';
                document.getElementById('ongkirDisplay').innerText = "Rp0";
            }

            document.getElementById('jenisPengirimanTerpilih').innerHTML = iconText;
            document.getElementById('inputJenisPengiriman').value = jenis;
            document.getElementById('inputJenisPengirimanForm').value = jenis; // SET IN FORM
            
            // Visual feedback on card
            document.querySelectorAll('.shipping-card').forEach(el => {
                el.classList.remove('selected');
                el.querySelector('.select-icon').classList.replace('bi-check-circle-fill', 'bi-circle');
                el.querySelector('.select-icon').classList.replace('text-primary', 'text-muted');
            });

            element.classList.add('selected');
            element.querySelector('.select-icon').classList.replace('bi-circle', 'bi-check-circle-fill');
            element.querySelector('.select-icon').classList.replace('text-muted', 'text-primary');

            // Trigger total recount (for Ongkir changes)
            document.getElementById('poinInput').dispatchEvent(new Event('input'));

            // Delay closing modal slightly
            setTimeout(() => {
                myGantiPengirimanModal.hide();
            }, 300);
        }
    </script>
</body>
</html>

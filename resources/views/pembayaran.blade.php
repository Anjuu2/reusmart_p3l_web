<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | ReUseMart</title>

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
        .action-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); transform: translateY(-2px); box-shadow: var(--shadow-glow);}

        /* PAGE SPECIFIC */
        .payment-wrapper {
            max-width: 600px;
            margin: 60px auto;
        }

        .invoice-card {
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            padding: 40px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .invoice-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--gradient-primary);
        }

        .timer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: var(--radius-md);
            padding: 16px 20px;
            margin-bottom: 30px;
        }
        .timer-title h4 { font-size: 1.1rem; color: #b45309; margin: 0; display: flex; align-items: center; gap: 8px;}
        .timer-title small { font-size: 0.85rem; color: #d97706; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif;}

        .countdown-boxes { display: flex; gap: 8px;}
        .cd-box {
            background: #ef4444; color: white; padding: 8px 16px; border-radius: 8px; font-weight: 700; font-variant-numeric: tabular-nums;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); font-size: 1.1rem; min-width: 60px; text-align: center;
        }

        .detail-row {
            margin-bottom: 24px;
        }
        .detail-label {
            font-size: 0.9rem;
            color: var(--color-text-light);
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .va-number {
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--color-secondary);
            letter-spacing: 2px;
            background: #f1f5f9;
            padding: 16px;
            border-radius: var(--radius-md);
            text-align: center;
            border: 2px dashed #cbd5e1;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        
        .copy-btn {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.9rem;
            color: var(--color-text-main);
            cursor: pointer;
            transition: all 0.2s;
        }
        .copy-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); }

        .total-amount {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--color-primary-dark);
            margin: 0;
            text-align: center;
        }

        hr.dashed {
            border: none;
            border-top: 2px dashed var(--color-border);
            margin: 30px 0;
        }

        .file-upload-box {
            border: 2px dashed var(--color-primary);
            border-radius: var(--radius-md);
            padding: 30px;
            text-align: center;
            background: #f1fdfaa6;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        .file-upload-box:hover { background: #ecfdf5; border-color: var(--color-primary-dark); }
        .file-upload-input {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;
        }
        .file-upload-icon { font-size: 2.5rem; color: var(--color-primary); margin-bottom: 10px; }
        .file-upload-text { font-weight: 600; color: var(--color-primary-dark); margin-bottom: 5px; }
        .file-upload-help { font-size: 0.85rem; color: var(--color-text-light); margin: 0; }

        .btn-pay {
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
        }
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            color: white;
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

    <!-- TOAST NOTIFICATIONS -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        @if (session('success'))
            <div id="liveToast" class="toast align-items-center text-bg-success border-0 fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-bold">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="liveToast" class="toast align-items-center text-bg-danger border-0 fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-bold">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

    <!-- CONTENT -->
    <main class="container">
        <div class="payment-wrapper">
            
            <div class="text-center mb-4">
                <h1 class="page-title">Selesaikan <span>Pembayaran</span></h1>
                <p class="text-muted mt-2">Segera lakukan pembayaran sebelum batas waktu berakhir.</p>
            </div>

            <div class="invoice-card">
                
                <!-- TIMER -->
                <div class="timer-header">
                    <div class="timer-title">
                        <h4><i class="bi bi-clock-history"></i> Bayar Sebelum</h4>
                        <small>{{ $tanggalTransaksiPlus1Menit->format('d M Y, H:i') }} WIB</small>
                    </div>
                    <div class="countdown-boxes">
                        <div id="countdown-minutes" class="cd-box">1m</div>
                        <div id="countdown-seconds" class="cd-box">00s</div>
                    </div>
                </div>

                <!-- VIRTUAL ACCOUNT -->
                <div class="detail-row">
                    <div class="detail-label text-center">Nomor Virtual Account Bank BCA</div>
                    <div class="va-number" id="vaNumber">
                        075048615248 
                        <button class="copy-btn" onclick="copyVA()" title="Salin VA">
                            <i class="bi bi-clipboard"></i>
                        </button>
                    </div>
                </div>

                <!-- TOTAL -->
                <div class="detail-row mb-0">
                    <div class="detail-label text-center">Total Tagihan</div>
                    <div class="total-amount">
                        Rp{{ number_format($totalHarga, 0, ',', '.') }}
                    </div>
                </div>

                <hr class="dashed">

                <!-- UPLOAD BUKTI -->
                <form action="{{ route('upload.bukti') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_transaksi" value="{{ request('id_transaksi') }}">
                    
                    <div class="detail-label text-center mb-3">Upload Bukti Transfer</div>
                    
                    <div class="file-upload-box" id="dropArea">
                        <input type="file" id="buktiPembayaran" name="bukti_pembayaran" accept="image/png, image/jpeg, image/jpg" class="file-upload-input"/>
                        <div id="uploadPlaceholder">
                            <i class="bi bi-cloud-arrow-up file-upload-icon"></i>
                            <p class="file-upload-text">Klik atau seret file ke sini</p>
                            <p class="file-upload-help">Format JPG/PNG • Maks 2MB</p>
                        </div>
                        <img id="previewImage" src="" alt="Preview Bukti" style="max-width: 100%; max-height: 250px; display: none; border-radius: 8px; margin: 0 auto; z-index: 5; position: relative;" />
                    </div>
                    
                    <div id="fileError" class="text-danger mt-2 text-center" style="display:none; font-size:0.85rem; font-weight: 600;">
                        <i class="bi bi-x-circle me-1"></i>Format file tidak valid! Pilih JPG/PNG.
                    </div>

                    <button type="submit" class="btn-pay">
                        <i class="bi bi-check-circle me-2"></i> Konfirmasi Pembayaran
                    </button>
                    <p class="text-muted text-center mt-3 mb-0" style="font-size: 0.8rem;">Pesanan akan diproses otomatis setelah pembayaran dikonfirmasi.</p>
                </form>

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- LOGIC SCRIPTS -->
    <script>
        // COUNTDOWN TIMER LOGIC
        // Using static countdown here to match original logic but it should ideally use backend time.
        // The original script set 1 minute from "now".
        let countDownDate = new Date().getTime() + 60 * 1000;
        const idTransaksi = "{{ request('id_transaksi') }}"; // Ambil id_transaksi dari URL

        function updateCountdown() {
            let now = new Date().getTime();
            let distance = countDownDate - now;

            if (distance < 0) {
                document.getElementById("countdown-minutes").textContent = "0m";
                document.getElementById("countdown-seconds").textContent = "00s";
                clearInterval(interval);

                // Jalankan fungsi batal transaksi
                fetch("{{ route('batal.transaksi') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id_transaksi: idTransaksi
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Waktu habis! " + data.message);
                        window.location.href = "{{ route('home') }}"; // Redirect ke home setelah pembatalan
                    } else {
                        console.log(data.message);
                    }
                })
                .catch(error => {
                    console.error("Terjadi kesalahan:", error);
                });

                return;
            }

            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown-minutes").textContent = minutes + "m";
            document.getElementById("countdown-seconds").textContent = (seconds < 10 ? "0" : "") + seconds + "s";
        }

        let interval = setInterval(updateCountdown, 1000);
        updateCountdown();

        // COPY VA LOGIC
        function copyVA() {
            navigator.clipboard.writeText("075048615248").then(() => {
                alert("Nomor Virtual Account berhasil disalin!");
            });
        }

        // IMAGE UPLOAD PREVIEW LOGIC
        const inputFile = document.getElementById('buktiPembayaran');
        const fileError = document.getElementById('fileError');
        const previewImage = document.getElementById('previewImage');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');

        inputFile.addEventListener('change', () => {
            const file = inputFile.files[0];
            if (!file) {
                fileError.style.display = 'none';
                previewImage.style.display = 'none';
                uploadPlaceholder.style.display = 'block';
                previewImage.src = '';
                return;
            }

            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                fileError.style.display = 'block';
                previewImage.style.display = 'none';
                uploadPlaceholder.style.display = 'block';
                previewImage.src = '';
                inputFile.value = ''; // reset input file
            } else {
                fileError.style.display = 'none';
                uploadPlaceholder.style.display = 'none'; // hide placeholder text
                
                // Tampilkan preview gambar
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>

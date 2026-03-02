<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk | ReUseMart</title>

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
            --color-text-main: #1e293b;
            --color-text-light: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            overflow: hidden;
            background-color: var(--color-secondary);
        }

        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        .background-animation {
            position: relative;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 1;
            transform: translate(-50%, -50%);
            object-fit: cover;
            filter: brightness(0.7); /* Darken video slightly */
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.6) 0%, rgba(5, 150, 105, 0.8) 100%);
            z-index: 2;
        }

        .content-wrapper {
            position: relative;
            z-index: 4;
            width: 100%;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }

        .hero-text {
            color: white;
            text-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .hero-text h1 {
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 24px;
        }

        .hero-text p {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .brand-logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            object-fit: cover;
        }

        .brand-text {
            font-size: 1.75rem;
            color: var(--color-secondary);
            margin: 0;
            letter-spacing: -0.5px;
        }
        
        .brand-text span {
            color: var(--color-primary);
        }

        .form-floating > label {
            color: var(--color-text-light);
            font-weight: 500;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            height: calc(3.5rem + 2px);
            font-weight: 500;
            color: var(--color-text-main);
            background-color: rgba(255,255,255,0.8);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            border-color: var(--color-primary);
            background-color: #fff;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .link-sub {
            color: var(--color-text-light);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
            font-size: 0.95rem;
        }

        .link-sub:hover {
            color: var(--color-primary);
        }

        .link-register {
            color: var(--color-secondary);
            text-decoration: none;
            font-weight: 700;
            background: #f1f5f9;
            padding: 12px;
            border-radius: 12px;
            display: block;
            text-align: center;
            transition: all 0.2s;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
        }

        .link-register:hover {
            background: #e2e8f0;
            color: var(--color-primary-dark);
        }

        /* Hide Number Spinners */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }

        @media (max-width: 991px) {
            .hero-text { display: none; }
            .background-animation { overflow-y: auto; height: 100vh; }
            .content-wrapper { padding: 40px 0; }
        }
    </style>
</head>
<body>

<section class="background-animation">
    <video class="video-background" autoplay loop muted playsinline>
        <source src="{{ asset('images/video.mp4') }}" type="video/mp4">
    </video>

    <div class="bg-overlay"></div>
    
    <div class="container content-wrapper">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
            
            <!-- Left Side Pitch -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-text pe-5">
                    <h1>Gunakan Kembali, Kurangi Sampah, Berbagi Lebih Banyak</h1>
                    <p>Bergabunglah bersama ribuan orang lainnya yang telah memilih cara belanja yang lebih pintar dan ramah lingkungan. Temukan barang berkualitas atau donasikan barang yang sudah tidak Anda butuhkan.</p>
                </div>
            </div>

            <!-- Right Side Login Card -->
            <div class="col-lg-5 col-md-8 col-11">
                <div class="glass-card">
                    <!-- Brand Logo inside card -->
                    <a href="{{ url('/') }}" class="brand-logo-container text-decoration-none">
                        <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                        <h2 class="brand-text">ReUse<span>Mart</span></h2>
                    </a>

                    <h4 class="mb-4 fw-bold">Selamat Datang Kembali</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger text-white border-0 rounded-3 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('login') }}" method="POST">
                        @csrf
                        
                        <!-- Role Selection -->
                        <div class="form-floating mb-3">
                            <select name="tipe_user" class="form-select" id="floatingTipeUser" required>
                                <option value="" selected disabled>Pilih Tipe Pengguna</option>
                                <option value="pembeli">Pembeli</option>
                                <option value="penitip">Penitip</option>
                                <option value="organisasi">Organisasi</option>
                                <option value="pegawai">Pegawai</option>
                            </select>
                            <label for="floatingTipeUser"><i class="bi bi-person-badge me-2"></i>Tipe Pengguna</label>
                        </div>

                        <!-- Email Input (Hidden for Organisasi) -->
                        <div class="form-floating mb-3" id="emailField">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" />
                            <label for="floatingInput"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
                        </div>

                        <!-- Organisasi Dropdown (Hidden initially) -->
                        <div class="form-floating mb-3 d-none" id="organisasiSelectWrapper">
                            <select name="id_organisasi" class="form-select" id="organisasiSelect">
                                <option value="" disabled selected>Pilih Organisasi</option>
                                @foreach($organisasiList as $org)
                                    <option value="{{ $org->id_organisasi }}">{{ $org->nama_organisasi }}</option>
                                @endforeach
                            </select>
                            <label for="organisasiSelect"><i class="bi bi-building me-2"></i>Nama Organisasi</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Kata Sandi" required />
                            <label for="floatingPassword"><i class="bi bi-lock me-2"></i>Kata Sandi</label>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ url('linkForm') }}" class="link-sub">Lupa Password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-login w-100">
                            Masuk ke Akun
                        </button>

                        <div class="mt-4">
                            <p class="text-center text-muted mb-2" style="font-size: 0.9rem;">Belum punya akun?</p>
                            <a href="{{ url('register') }}" class="link-register">
                                <i class="bi bi-person-plus me-2"></i>Buat Akun ReUseMart
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeUserSelect = document.getElementById('floatingTipeUser');
        const emailField = document.getElementById('emailField');
        const emailInput = document.getElementById('floatingInput');
        
        const orgWrapper = document.getElementById('organisasiSelectWrapper');
        const orgSelect = document.getElementById('organisasiSelect');

        tipeUserSelect.addEventListener('change', function () {
            if (this.value === 'organisasi') {
                // Show Organisasi, Hide Email
                emailField.classList.add('d-none');
                emailInput.value = ''; // clear out email
                emailInput.required = false;

                orgWrapper.classList.remove('d-none');
                orgSelect.required = true;
            } else {
                // Show Email, Hide Organisasi
                emailField.classList.remove('d-none');
                emailInput.required = true;

                orgWrapper.classList.add('d-none');
                orgSelect.value = ''; // clear out dropdown
                orgSelect.required = false;
            }
        });
    });
</script>

</body>
</html>
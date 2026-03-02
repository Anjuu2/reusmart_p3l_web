<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | ReUseMart</title>

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
            filter: brightness(0.6); 
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.7) 0%, rgba(16, 185, 129, 0.5) 100%);
            z-index: 2;
        }

        .content-wrapper {
            position: relative;
            z-index: 4;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .brand-logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
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

        .role-btn {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: var(--color-text-main);
            padding: 20px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            text-decoration: none;
            cursor: pointer;
            width: 100%;
        }

        .role-btn i {
            font-size: 2.5rem;
            color: var(--color-primary);
            transition: transform 0.3s;
        }

        .role-btn:hover {
            background: #ecfdf5;
            border-color: var(--color-primary);
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.1);
        }

        .role-btn:hover i {
            transform: scale(1.1);
        }

        .role-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        .role-desc {
            font-size: 0.85rem;
            color: var(--color-text-light);
            margin: 0;
            line-height: 1.4;
        }

        .login-link {
            display: inline-block;
            margin-top: 30px;
            color: var(--color-text-light);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-link:hover {
            color: var(--color-primary);
        }

        /* -------------------------
           MODAL STYLING
        -------------------------- */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .modal-header {
            background: var(--color-bg);
            border-bottom: 1px solid var(--color-border);
            padding: 24px;
        }

        .modal-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: var(--color-secondary);
        }

        .modal-body {
            padding: 30px 24px;
        }

        .modal-footer {
            border-top: 1px solid var(--color-border);
            padding: 20px 24px;
            background: var(--color-bg);
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-text-light);
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            font-weight: 500;
            color: var(--color-text-main);
        }

        .form-control:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-light-custom {
            background: #f1f5f9;
            color: var(--color-text-main);
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-light-custom:hover {
            background: #e2e8f0;
        }
    </style>
</head>
<body>

<section class="background-animation">
    <video class="video-background" autoplay loop muted playsinline>
        <!-- Matching the video from login to keep aesthetic consistent -->
        <source src="{{ asset('images/video.mp4') }}" type="video/mp4">
    </video>

    <div class="bg-overlay"></div>

    <div class="container content-wrapper">
        <div class="glass-card">
            <a href="{{ url('/') }}" class="brand-logo-container text-decoration-none">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                <h2 class="brand-text">ReUse<span>Mart</span></h2>
            </a>

            <h4 class="mb-2 fw-bold" style="color: var(--color-secondary);">Buat Akun Baru</h4>
            <p class="text-muted mb-4">Pilih peran yang paling sesuai untuk Anda dan mulailah perjalanan berkelanjutan bersama kami.</p>

            <div class="row g-3">
                <div class="col-6">
                    <div class="role-btn" data-bs-toggle="modal" data-bs-target="#regisPembeliModal">
                        <i class="bi bi-person-heart"></i>
                        <div>
                            <h5 class="role-title">Pembeli</h5>
                            <p class="role-desc">Beli barang & dukung donasi</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="role-btn" data-bs-toggle="modal" data-bs-target="#regisOrganisasiModal">
                        <i class="bi bi-buildings"></i>
                        <div>
                            <h5 class="role-title">Organisasi</h5>
                            <p class="role-desc">Kelola & terima donasi massal</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ url('login') }}" class="login-link">
                <i class="bi bi-arrow-left-short me-1"></i>Sudah punya akun? Masuk
            </a>
        </div>
    </div>
</section>

<!-- MODAL: REGISTRASI PEMBELI -->
<div class="modal fade" id="regisPembeliModal" tabindex="-1" aria-labelledby="regisPembeliModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('pembeli.register') }}" method="POST" class="modal-content">
            @csrf
            
            <div class="modal-header">
                <h5 class="modal-title" id="regisPembeliModalLabel">
                    <i class="bi bi-person-fill me-2 text-primary"></i>Registrasi Pembeli
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_pembeli" class="form-control" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Pilih username" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="notelp" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-light-custom" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn-custom">Konfirmasi Pendaftaran</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: REGISTRASI ORGANISASI -->
<div class="modal fade" id="regisOrganisasiModal" tabindex="-1" aria-labelledby="regisOrganisasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('organisasi.register') }}" method="POST" class="modal-content">
            @csrf
            
            <div class="modal-header">
                <h5 class="modal-title" id="regisOrganisasiModalLabel">
                    <i class="bi bi-building-add me-2 text-primary"></i>Registrasi Organisasi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Organisasi</label>
                        <input type="text" name="nama_organisasi" class="form-control" placeholder="Nama instansi/komunitas" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat Lengkap</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat kantor/pusat" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Operasional</label>
                        <input type="email" name="email" class="form-control" placeholder="organisasi@example.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password Akses</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-light-custom" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn-custom">Konfirmasi Pendaftaran</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

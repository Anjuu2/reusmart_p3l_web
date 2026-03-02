<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | ReUseMart</title>

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
            filter: brightness(0.7); 
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
            max-width: 480px;
            width: 100%;
        }

        .brand-logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
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

        .btn-reset {
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

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .link-back {
            color: var(--color-text-light);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 24px;
        }

        .link-back:hover {
            color: var(--color-secondary);
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
        <div class="glass-card text-center">
            
            <a href="{{ url('/') }}" class="brand-logo-container text-decoration-none">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="brand-logo">
                <h2 class="brand-text">ReUse<span>Mart</span></h2>
            </a>

            <h4 class="mb-2 fw-bold" style="color: var(--color-secondary)">Reset Password</h4>
            <p class="text-muted mb-4" style="font-size: 0.95rem;">Jangan khawatir! Masukkan email dan password baru Anda di bawah ini untuk memulihkan akun.</p>

            @if ($errors->any())
                <div class="alert alert-danger bg-danger text-white border-0 rounded-3 mb-4 text-start">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.ubah') }}" method="POST" class="text-start">
                @csrf
                
                <!-- Role Selection -->
                <div class="form-floating mb-3">
                    <select name="tipe_user" class="form-select" id="floatingTipeUser" required>
                        <option value="" selected disabled>Pilih Peran Akun</option>
                        <option value="pembeli">Pembeli</option>
                        <option value="penitip">Penitip</option>
                        <option value="organisasi">Organisasi</option>
                    </select>
                    <label for="floatingTipeUser"><i class="bi bi-person-badge me-2"></i>Tipe Pengguna</label>
                </div>

                <!-- Email Input -->
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                    <label for="floatingEmail"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
                </div>

                <!-- New Password Input -->
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password Baru" required>
                    <label for="floatingPassword"><i class="bi bi-key me-2"></i>Password Baru</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-reset w-100">
                    <i class="bi bi-arrow-repeat me-2"></i>Simpan Password Baru
                </button>
            </form>

            <a href="{{ url('login') }}" class="link-back">
                <i class="bi bi-arrow-left"></i> Kembali ke halaman Login
            </a>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

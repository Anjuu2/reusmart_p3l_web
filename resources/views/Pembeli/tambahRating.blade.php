<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beri Rating Produk - ReUseMart</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --color-primary: #10b981;
            --color-primary-dark: #059669;
            --color-primary-light: #d1fae5;
            --color-secondary: #0f172a;
            --color-bg: #f8fafc;
            --color-surface: #ffffff;
            --color-text: #334155;
            --color-text-light: #64748b;
            --color-border: #e2e8f0;
            --color-star: #e2e8f0;
            --color-star-active: #f59e0b;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-pill: 50px;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.02);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        /* Abstract Background Elements */
        body::before {
            content: ''; position: fixed; top: -10%; left: -5%; width: 50vw; height: 50vw;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
            border-radius: 50%; z-index: -1;
        }
        body::after {
            content: ''; position: fixed; bottom: -10%; right: -5%; width: 40vw; height: 40vw;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.08) 0%, transparent 70%);
            border-radius: 50%; z-index: -1;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; font-weight: 700; color: var(--color-secondary); }

        .card-rating {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 550px;
            overflow: hidden;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .rating-header {
            padding: 30px 40px 20px;
            text-align: center;
            border-bottom: 1px solid var(--color-border);
        }

        .rating-header i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; height: 60px;
            background: var(--color-primary-light);
            color: var(--color-primary);
            border-radius: 50%;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .rating-body {
            padding: 30px 40px;
        }

        /* Detail Barang Area */
        .product-preview {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 16px;
            border: 1px solid var(--color-border);
            margin-bottom: 30px;
        }

        .preview-images {
            display: flex;
            gap: -10px;
            position: relative;
        }

        .preview-images img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s;
        }
        .preview-images img:hover {
            transform: scale(1.1) z-index: 10;
        }
        .preview-images img:nth-child(2) { transform: translateX(-20px); }
        .preview-images img:nth-child(3) { transform: translateX(-40px); }

        .product-info h5 {
            margin: 0 0 5px 0;
            font-size: 1.1rem;
            color: var(--color-secondary);
        }
        .product-info p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--color-text-light);
            display: flex;
            flex-direction: column;
        }
        .product-info span.price {
            color: var(--color-primary);
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
        }

        /* Star Rating System */
        .rating-selector {
            text-align: center;
            margin-bottom: 30px;
        }
        .rating-selector p {
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .stars {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 5px;
        }

        .stars input[type="radio"] {
            display: none;
        }

        .stars label {
            color: var(--color-star);
            cursor: pointer;
            font-size: 2.5rem;
            transition: all 0.2s;
        }

        /* Hover and Checked states */
        .stars label:hover,
        .stars label:hover ~ label,
        .stars input[type="radio"]:checked ~ label {
            color: var(--color-star-active);
            transform: scale(1.1);
            text-shadow: 0 0 15px rgba(245, 158, 11, 0.4);
        }

        /* Feedback animation when clicked */
        .stars input[type="radio"]:checked + label {
            animation: pop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes pop {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1.1); }
        }

        /* Buttons */
        .btn-custom {
            background: var(--color-primary); color: white; border: none; padding: 12px 24px; border-radius: var(--radius-pill);
            font-weight: 600; font-size: 0.95rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); width: 100%; display: flex; justify-content: center; align-items: center; gap: 8px;
        }
        .btn-custom:hover { background: var(--color-primary-dark); color: white; transform: translateY(-2px); box-shadow: 0 8px 15px rgba(16, 185, 129, 0.25); }

        .btn-outline-custom { background: white; color: var(--color-text); border: 1px solid var(--color-border); padding: 12px 24px; border-radius: var(--radius-pill); font-weight: 600; transition: all 0.2s; width: 100%; text-align: center; text-decoration: none; display: inline-block;}
        .btn-outline-custom:hover { background: #f8fafc; color: var(--color-secondary); border-color: #cbd5e1; text-decoration: none;}

        .action-group {
            display: flex;
            gap: 15px;
        }
        .action-group > * { flex: 1; }

        @media (max-width: 576px) {
            .rating-header, .rating-body { padding: 20px; }
            .action-group { flex-direction: column; }
        }
    </style>
</head>
<body>

    <div class="card-rating">
        <div class="rating-header">
            <i class="bi bi-star-fill"></i>
            <h3>Penilaian Produk</h3>
            <p class="text-muted mb-0">Bagaimana kepuasan Anda terhadap barang yang Anda terima?</p>
        </div>

        <div class="rating-body">
            <!-- Product Information -->
            <div class="product-preview">
                <div class="preview-images">
                    @forelse ($barang->fotoBarang->take(2) as $index => $foto)
                        <img src="{{ asset('images/barang/' . $foto->nama_file) }}" alt="Foto" style="z-index: {{ 10 - $index }};">
                    @empty
                        <div style="width: 70px; height: 70px; background: #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #94a3b8;"><i class="bi bi-image"></i></div>
                    @endforelse
                </div>
                <div class="product-info">
                    <h5>{{ $barang->nama_barang }}</h5>
                    <p>
                        <span>Penjual: <strong>{{ $barang->penitip->nama_penitip ?? '-' }}</strong></span>
                        <span class="price">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                    </p>
                </div>
            </div>

            <!-- Form -->
            <form id="ratingForm" action="{{ route('pembeli.storeRating') }}" method="POST">
                @csrf
                <input type="hidden" name="id_barang" value="{{ $barang->id_barang }}">

                <div class="rating-selector">
                    <p>Pilih Rating Bintang</p>
                    <div class="stars">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required {{ (old('rating', $existing->rating ?? '') == $i) ? 'checked' : '' }} />
                            <label for="star{{ $i }}" title="{{ $i }} Bintang"><i class="bi bi-star-fill"></i></label>
                        @endfor
                    </div>
                    @error('rating')
                        <div class="text-danger mt-2" style="font-size: 0.85rem; font-weight: 500;"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="action-group">
                    <a href="{{ route('pembeli.riwayatTransaksi') }}" class="btn-outline-custom">Nanti Saja</a>
                    <button type="submit" class="btn-custom">Kirim Penilaian</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('ratingForm').addEventListener('submit', function(e) {
            // Check if any radio is selected
            const ratingSelected = document.querySelector('input[name="rating"]:checked');
            if(!ratingSelected) {
                e.preventDefault();
                alert('Silakan pilih rating bintang terlebih dahulu.');
                return;
            }

            if(!confirm('Kirim penilaian bintang ' + ratingSelected.value + ' ini?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

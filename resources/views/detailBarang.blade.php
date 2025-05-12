<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReUseMart - Collection</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap; /* agar tidak melipat */
        }

        .logo {
            margin-left: -40px;
        }
        header {
            background-color: #ffffff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 80px; /* atur tinggi navbar */
            box-shadow: 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }

        header .logo img {
            height: 60px;
        }

        nav ul {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-size: 15px;
            font-weight: 600;
        }

        .cart-search {
            display: flex;
            align-items: center;
        }

        .cart-search select,
        .cart-search input[type="search"] {
            width: 200px;
            padding: 8px;
            border-radius: 20px;
            border: 1px solid #ccc;
            margin-right: 10px;
            outline: none;
        }

        .cart-search input[type="search"] {
            width: 200px;
        }

        .cart-search a img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .cart-search .icons {
            display: flex;
            align-items: center;
        }

        .cart-search .icons a {
            margin-left: 15px;
        }

        .navbar-shadow-separator {
            height: 1px;
            background-color: #ccc;
            box-shadow: 0 4px 6px -2px rgba(0, 0, 0, 0.15);
            margin-bottom: 5px;
        }

        /* Container untuk Kategori */
        .category-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(85px, max-content));
            gap: 10px;
            justify-items: center;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
        }

        /* Setiap Kartu Kategori */
        .category-card {
            background-color: #f9f9f9;
            padding: 8px;
            border-radius: 5px !important;
            text-align: center;
            justify-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            height: 40px !important;
            margin: 0;
            text-decoration: none;
            width: 100%;
        }

        .category-card h3 {
            margin-top: 5px;
            margin: 2px 0 0 0;
            font-size: 8px;
            color: #333;
            text-decoration: none;
        }

        .carousel-divider {
            width: 80%;
            height: 1px; 
            background-color: grey; 
            margin: 20px auto; 
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #f4f4f4;
            padding: 10px 50px;  
            border-top: 1px solid #333;
            font-size: 14px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;  /* Menempatkan elemen di kiri dan kanan */
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;  
        }

        .footer-left p {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        /* Footer Middle - Social Icons */
        .footer-middle {
            display: flex;
            justify-content: right;
            flex: 1;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .social-icon img {
            width: 21px;
            height: 21px;
            transition: transform 0.3s;
        }

        .social-icon:hover img {
            transform: scale(1.2);
        }

        /* Carousel Section */
        .product-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
            margin: 0 auto;
            width: 80%;
            box-sizing: border-box;
        }

        /* Gambar Produk Carousel */
        .carousel-inner {
            width: 100%;
            height: 400px;  /* Menentukan tinggi carousel */
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;  /* Agar gambar mengisi seluruh area tanpa terdistorsi */
            border-radius: 8px;
        }

        /* Informasi Produk */
        .product-info {
            width: 50%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Kontainer untuk Tombol */
        .button-container {
            display: flex;
            gap: 10px;  /* Memberikan jarak antar tombol */
            margin-top: 10px;  /* Memberikan ruang antara tombol dan elemen lainnya */
        }

        /* Tombol Add to Cart */
        .add-to-cart-btn{
            background-color: white;  /* Latar belakang putih */
            color: #28a745;  /* Teks hijau */
            padding: 10px 20px;
            border: 2px solid #28a745;  /* Border hijau */
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            width: 48%;  /* Membuat tombol lebar setengah container */
        }

        .buy-now-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
            width: 48%;  /* Membuat tombol lebar setengah container */
        }

        /* Efek Hover Tombol */
        .add-to-cart-btn:hover{
            background-color: #28a745;  /* Latar belakang hijau saat hover */
            color: white;  /* Warna teks menjadi putih saat hover */
            border: 2px solid #28a745;
        }

        .buy-now-btn:hover {
            background-color: #218838;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: row;
                justify-content: space-between;
            }

            nav ul {
                margin-top: 15px;
                flex-direction: row;
                align-items: center;
                gap: 15px;
            }

            nav ul li {
                margin: 5px 0;
            }

            .cart-search input[type="search"] {
                width: 150px;
                display: none;
            }

            footer {
                padding: 5px 40px;  
            }

            .footer-left p {
                font-size: 10px;
            }

            .social-icon img {
                width: 14px;
                height: 14px;
            }

            footer {
                padding: 5px 40px;  
            }

            .footer-left p {
                font-size: 10px;
            }

            .social-icon img {
                width: 14px;
                height: 14px;
            }

            .product-container {
                flex-direction: column; /* Gambar dan informasi produk dalam satu kolom pada layar kecil */
            }

            .carousel-inner {
                height: 300px;  /* Menurunkan tinggi carousel pada perangkat kecil */
            }

            .add-to-cart-btn, .buy-now-btn {
                width: 100%;  /* Membuat tombol mengisi lebar penuh pada perangkat kecil */
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo2.png') }}" alt="Brand Logo">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="/kategori">Collection</a></li>
                    <li><a href="/about">About Us</a></li>
                </ul>
            </nav>
            <!-- Cart, Search, and Location -->
            <div class="cart-search">
                <!-- Search Input -->
                <input type="search" placeholder="Search for items...">

                <!-- Icons -->
                <div class="icons">
                    <a href="#"><img src="https://img.icons8.com/material/24/000000/shopping-cart.png" alt="Cart"></a>
                    <a href="#"><img src="https://img.icons8.com/material/24/000000/user.png" alt="Account"></a>
                </div>
            </div>
        </div>
    </header>

    <div class="navbar-shadow-separator"></div>
    
    <!-- Main Section -->
    <main>
        <section class="product-detail">
            <div class="product-container">
                <!-- Gambar Produk - Carousel -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>

                    <!-- Carousel Inner -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/' . $product->foto_barang) }}" alt="{{ $product->nama_barang }}" class="product-image">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/' . $product->foto_barang_2) }}" alt="{{ $product->nama_barang }} (2)" class="product-image">
                        </div>
                    </div>

                    <!-- Carousel Controls (Next and Previous Buttons) -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Informasi Produk -->
                <div class="product-info" style="line-height: 1.0;">
                    <h1 class="product-name" style="font-size: 30px; margin-bottom: 10px;"><strong>{{ $product->nama_barang }}</strong></h1>
                    <p style="font-size: 14px; color: grey; margin: 0 0 6px;">{{ $product->kategori->nama_kategori }}</p>
                    <p class="product-description" style="text-align: justify; margin: 0 0 8px;">{{ $product->deskripsi }}</p>
                    <p style="text-align: left; color: grey; margin: 0 0 8px;">Berat barang: {{ $product->berat }} kg</p>

                    <!-- Informasi Garansi Produk -->
                <div class="garansi-info" style="margin: 0 0 8px;">
                    <p style="font-size: 15px; font-weight: bold; margin: 0;"><strong>Garansi Status:</strong></p>
                    
                    <!-- Cek jika status garansi tersedia -->
                    @if ($garansi_status !== "Garansi Tidak Tersedia")
                        <p style="font-size: 13px;">
                            {{ $garansi_status }} hingga {{ \Carbon\Carbon::parse($product->tanggal_garansi)->format('d M Y') }}
                        </p>
                    @else
                        <p style="font-size: 13px;">{{ $garansi_status }}</p>
                    @endif
                </div>

                    <div class="additional-info" style="margin: 0 0 8px;">
                        <p style="margin: 0;"><strong>Status Barang:</strong> {{ $product->status_barang }}</p>
                    </div>

                    <p class="product-price" style="font-size: 25px; margin: 4px 0 12px;">
                        <strong>Rp{{ number_format($product->harga_jual, 0, ',', '.') }}</strong>
                    </p>
                    <!-- Kontainer untuk Tombol -->
                    <div class="button-container" style="margin-top: 35px;">
                        <!-- Tombol Add to Cart -->
                        <button class="add-to-cart-btn">Add to Cart</button>
                        <!-- Tombol Beli Barang -->
                        <button class="buy-now-btn">Beli Barang</button>
                    </div>
                </div>
            </div>

            <div class="related-products" style="margin-top: 50px; margin-left: 150px;">
                <h3>Produk Serupa</h3>
                <div class="related-products-grid" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    @forelse($produk_serupa as $item)
                        <a href="{{ url('product/' . $item->id_barang) }}" class="related-product-card" style="width: 200px; text-decoration: none; color: inherit;">
                            <img src="{{ asset('images/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}" style="width: 100%; height: 150px; object-fit: cover;">
                            <div style="padding: 8px;">
                                <p style="font-size: 13px; color: grey; margin: 4px 0;">{{ $item->kategori->nama_kategori ?? 'Kategori' }}</p>
                                <h4 style="font-size: 16px; margin: 0 0 4px;">{{ $item->nama_barang }}</h4>
                                <p style="font-size: 14px; font-weight: bold; margin: 0;">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @empty
                        <p>Tidak ada produk serupa untuk ditampilkan.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <p>© 2024 Reusemart. All rights reserved.</p>
            </div>
            <div class="footer-middle">
                <div class="social-icons">
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/facebook.png" alt="Facebook"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/twitter.png" alt="Twitter"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/instagram.png" alt="Instagram"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/pinterest.png" alt="Pinterest"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/youtube.png" alt="YouTube"></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

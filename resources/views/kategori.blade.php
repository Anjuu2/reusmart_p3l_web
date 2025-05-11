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

        .product-container {
            display: flex;  
            justify-content: flex-start; 
            align-items: flex-start;
            gap: 10px;  
            margin-top: 5px;
            flex-wrap: wrap;  
            margin-left: 125px;
            margin-right: 125px;
        }

        /* Kartu Produk */
        .product-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
            margin: 10px auto;
            padding: 10px;
            display: block;
            text-decoration: none;
            color: inherit;
            border: 2px solid #f1f1f1;
            width: calc(20% - 10px);
            margin-bottom: 10px; 
            height: 400px;
        }

        .product-card:hover {
            transform: scale(1.05); /* Memperbesar produk sedikit saat hover */
        }

        /* Gambar Produk */
        .product-image {
            width: 100%;
            height: 190px;
            border-radius: 10px;
            margin-top: 10px;
            object-fit: cover;
        }

        /* Informasi Produk */
        .product-info {
            margin-top: 15px;
        }

        /* Nama Kategori Produk */
        .product-category {
            font-size: 10px;
            color: #777;
            text-align: left;
        }

        /* Nama Produk */
        .product-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin: 10px 0;
        }

        /* Rating Produk */
        .product-rating {
            font-size: 10px;
            color: #ff5a5f;
        }

        /* Nama Merek Produk */
        .product-brand {
            font-size: 11px;
            color: #777;
        }

        /* Harga Produk */
        .product-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        /* Harga Produk (Di kiri) */
        .price-container {
            flex: 1;
            text-align: left;
        }

        .current-price {
            font-size: 13px;
            font-weight: bold;
            color: #333;
            flex-direction: column;
        }

        .add-to-cart-container {
            display: flex;
            justify-content: flex-end;
        }

        /* Tombol Add to Cart */
        .add-to-cart {
            background-color: #F0FFF0;
            color: #28a745;
            padding: 5px 10px;
            border: 2px solid #F0FFF0;;
            border-radius: 6px;
            display: flex;
            align-items: center;
            font-size: 11px;
            cursor: pointer;
        }

        .add-to-cart img {
            margin-right: 10px; /* Jarak antara ikon cart dan teks Add */
        }

        .add-to-cart:hover {
            background-color: #ACE1AF;
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

            .category-container {
                grid-template-columns: repeat(6, 1fr);
                margin-left: 60px;
                margin-right: auto;
                gap: 5px;
            }

            .category-card {
                height: 30px;
            }

            .category-card h3 {
                font-size: 7px;
            }

            .product-container {
                margin-left: 60px;
                margin-right: 60px;
                gap: 1px;
                
            }

            .product-card {
                width: calc(20% - 10px);
                height: 400px;
                margin-bottom: 10px;
                height: 280px;
                flex-direction: column;
            }

            /* Gambar Produk */
            .product-image {
                width: 100%;
                height: 80px;
                object-fit: cover;
            }

            /* Nama Kategori Produk */
            .product-category {
                font-size: 6px;
            }

            /* Nama Produk */
            .product-name {
                font-size: 9px;
            }

            /* Rating Produk */
            .product-rating {
                font-size: 9px;
            }

            /* Nama Merek Produk */
            .product-brand {
                font-size: 8px;
            }

            .current-price {
                font-size: 6px;
                flex-direction: column;
            }

            /* Tombol Add to Cart */
            .add-to-cart {
                padding: 2px 4px;
                font-size: 6px;
            }

            .add-to-cart img {
                margin-right: 5px; 
                width: 8px;
                height: 8px;
            }

            .add-to-cart:hover {
                background-color: #ACE1AF;
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
        <!-- Featured Categories -->
        <div class="category-container">
            <!-- Category 1 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Elektronik & Gadget</h3>
            </a>
            <!-- Category 2 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Pakaian & Aksesori</h3>
            </a>
            <!-- Category 3 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Perabotan Rumah Tangga</h3>
            </a>
            <!-- Category 4 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Buku, Alat Tulis, Peralatan Sekolah</h3>
            </a>
            <!-- Category 5 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Hobi, Mainan, Koleksi</h3>
            </a>
            <!-- Category 6 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Perlengkapan Bayi & Anak</h3>
            </a>
            <!-- Category 7 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Otomotif & Aksesori</h3>
            </a>
            <!-- Category 8 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Perlengkapan Taman & Outdoor</h3>
            </a>
            <!-- Category 9 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Peralatan Kantor & Industri</h3>
            </a>
            <!-- Category 10 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <h3>Kosmetik & Perawatan Diri</h3>
            </a>
        </div>

        <div class="carousel-divider"></div>

        <div class="product-container">
            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/stroller.png') }}" alt="Chicco Trolleyme Stroller" class="product-image">
                <div class="product-info">
                    <p class="product-category">Perlengkapan Bayi & Anak</p>
                    <h3 class="product-name">JOIE Muze Travel System Stroller</h3>
                    <div class="product-rating">
                        <span>★ (4.0)</span>
                    </div>
                    <p class="product-brand">By StevenAndre</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp2.896.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/sofa.png') }}" alt="sofa" class="product-image">
                <div class="product-info">
                    <p class="product-category">Perabotan Rumah Tangga</p>
                    <h3 class="product-name">Ashley Brise Sofa L Sectional Fabric</h3>
                    <div class="product-rating">
                        <span>★ (4.5)</span>
                    </div>
                    <p class="product-brand">By DionXius</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp1.276.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/sepatu.png') }}" alt="sepatu" class="product-image">
                <div class="product-info">
                    <p class="product-category">Pakaian & Aksesori</p>
                    <h3 class="product-name">New Balance 327 Women's Sneakers</h3>
                    <div class="product-rating">
                        <span>★ (4.7)</span>
                    </div>
                    <p class="product-brand">By XaveriusJohn</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp3.024.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/kamera.png') }}" alt="kamera" class="product-image">
                <div class="product-info">
                    <p class="product-category">Elektronik & Gadget </p>
                    <h3 class="product-name">Canon EOS 3000D Kit EF-S 18-55mm f/3.5-5.6 III</h3>
                    <div class="product-rating">
                        <span>★ (4.3)</span>
                    </div>
                    <p class="product-brand">By MarcelaCan</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp5.985.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/kalkulator.png') }}" alt="kalkulator" class="product-image">
                <div class="product-info">
                    <p class="product-category"> Buku, Alat Tulis, & Peralatan Sekolah</p>
                    <h3 class="product-name">Casio Kalkulator Saintifik FX-991</h3>
                    <div class="product-rating">
                        <span>★ (4.5)</span>
                    </div>
                    <p class="product-brand">By AntonTung</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp210.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/kalkulator.png') }}" alt="kalkulator" class="product-image">
                <div class="product-info">
                    <p class="product-category"> Buku, Alat Tulis, & Peralatan Sekolah</p>
                    <h3 class="product-name">Casio Kalkulator Saintifik FX-991</h3>
                    <div class="product-rating">
                        <span>★ (4.5)</span>
                    </div>
                    <p class="product-brand">By AntonTung</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp210.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/kalkulator.png') }}" alt="kalkulator" class="product-image">
                <div class="product-info">
                    <p class="product-category"> Buku, Alat Tulis, & Peralatan Sekolah</p>
                    <h3 class="product-name">Casio Kalkulator Saintifik FX-991</h3>
                    <div class="product-rating">
                        <span>★ (4.5)</span>
                    </div>
                    <p class="product-brand">By AntonTung</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp210.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/kalkulator.png') }}" alt="kalkulator" class="product-image">
                <div class="product-info">
                    <p class="product-category"> Buku, Alat Tulis, & Peralatan Sekolah</p>
                    <h3 class="product-name">Casio Kalkulator Saintifik FX-991</h3>
                    <div class="product-rating">
                        <span>★ (4.5)</span>
                    </div>
                    <p class="product-brand">By AntonTung</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp210.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>
            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/kalkulator.png') }}" alt="kalkulator" class="product-image">
                <div class="product-info">
                    <p class="product-category"> Buku, Alat Tulis, & Peralatan Sekolah</p>
                    <h3 class="product-name">Casio Kalkulator Saintifik FX-991</h3>
                    <div class="product-rating">
                        <span>★ (4.5)</span>
                    </div>
                    <p class="product-brand">By AntonTung</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp210.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>

            <a href="{{ url('product-detail-page') }}" class="product-card">
                <img src="{{ asset('images/kalkulator.png') }}" alt="kalkulator" class="product-image">
                <div class="product-info">
                    <p class="product-category"> Buku, Alat Tulis, & Peralatan Sekolah</p>
                    <h3 class="product-name">Casio Kalkulator Saintifik FX-991</h3>
                    <div class="product-rating">
                        <span>★ (4.5)</span>
                    </div>
                    <p class="product-brand">By AntonTung</p>
                </div>
                <!-- Harga dan Tombol Add -->
                <div class="product-price">
                    <div class="price-container">
                        <span class="current-price">Rp210.000,00</span>
                    </div>
                    <div class="add-to-cart-container">
                        <button class="add-to-cart">
                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                        </button>
                    </div>
                </div>
            </a>
        </div>

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReUseMart - Home</title>

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

        #carouselExampleCaptions {
            max-height: 500px;
            overflow: hidden;
        }

        .carousel-item {
            height: 400px;
            position: relative;
        }

        .carousel-item img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .carousel-item a:hover img {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            cursor: pointer; /* Menambahkan pointer saat hover */
        }

        .carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.5); /* latar belakang transparan gelap */
            color: white;
            text-align: left;
        }

        /* Garis Pemisah di Bawah Carousel */
        .carousel-divider {
            width: 80%;
            height: 1px; /* tebal garis */
            background-color: #333; /* warna garis */
            margin: 20px auto; /* jarak dari carousel */
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* bayangan untuk garis */
        }

        /* Judul Kategori */
        .category-title {
            text-align: center;
            margin-top: 20px;
        }

        .category-title h2 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }

        /* Container untuk Kategori */
        .category-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(85px, max-content));
            gap: 10px;
            justify-items: center;
            margin-top: 20px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        /* Setiap Kartu Kategori */
        .category-card {
            background-color: #f9f9f9;
            padding: 8px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            height: 100px;
            margin: 0;
            text-decoration: none;
        }

        .category-card img {
            width: 75%;
            height: 65px;
            object-fit: cover;
            border-radius: 10px;
        }

        .category-card h3 {
            margin-top: 5px;
            margin: 2px 0 0 0;
            font-size: 8px;
            color: #333;
            text-decoration: none;
        }

        .populer-produk{
            text-align: left;
            margin-top: 30px;
            margin-left: 125px;
        }

        .populer-produk h2 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .product-container {
            display: flex;  /* Menggunakan Flexbox */
            justify-content: space-between;  /* Membuat produk bersebelahan dengan jarak yang sama */
            gap: 10px;  /* Memberikan jarak antar produk */
            margin-top: 5px;
            flex-wrap: wrap;  /* Memastikan produk akan membungkus ke baris berikutnya jika ruang tidak cukup */
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
        
        /* Footer Container */
        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #f4f4f4;
            border-top: 1px solid #333;
            height: 100px;
        }

        .footer-left, .footer-middle, .footer-right {
            flex: 1;
        }

        /* Footer Left - Copyright */
        .footer-left p {
            margin: 0;
            font-size: 12px;
            color: grey;
        }

        /* Footer Middle - Social Icons */
        .footer-middle p {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }

        .social-icon img {
            width: 25px;
            height: 25px;
            transition: transform 0.3s;
        }

        .social-icon:hover img {
            transform: scale(1.2);
        }

        /* Footer Right - Discount Information */
        .footer-right p {
            font-size: 10px;
            color:rgb(187, 223, 196);
            text-align: right;
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color:rgb(187, 223, 196);
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .back-to-top img {
            width: 20px;
            height: 20px;
            color: white;
        }

        /* Hover Effect for Back to Top */
        .back-to-top:hover {
            background-color: #218838;
            cursor: pointer;
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

            .category-container {
                grid-template-columns: repeat(6, 1fr);
            }

            .category-card img {
                width: 65%;
                height: 45px;
            }

            .category-card {
                height: 90px;
            }

            .populer-produk{
                text-align: left;
                margin-top: 20px;
                margin-left: 65px;
            }

            .product-container {
                margin-left: 60px;
                margin-right: 60px;
                gap: 1px;
            }

            .product-card {
                width: calc(20% - 10px); /* Produk akan lebih besar pada layar kecil */
                height: 400px;
                margin-bottom: 10px; /* Menambahkan jarak antara produk */
                height: 280px;
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
                font-size: 8px;
            }

            /* Tombol Add to Cart */
            .add-to-cart {
                padding: 2px 4px;
                font-size: 8px;
            }

            .add-to-cart img {
                margin-right: 5px; 
                width: 10px;
                height: 10px;
            }

            .add-to-cart:hover {
                background-color: #ACE1AF;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <!-- Hamburger Menu (Visible only on small screens) -->
            <div class="menu-toggle" id="menu-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <div class="logo">
                <img src="{{ asset('images/logo2.png') }}" alt="Brand Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="#">Collection</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About Us</a></li>
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
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="{{ url('product-detail-page') }}"> <!-- Ganti URL sesuai halaman detail produk -->
                        <img src="{{ asset('images/laptop.jpg') }}" class="d-block w-100" alt="Laptop">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Acer Swift X14</h5>
                        <p>Ditenagai prosesor AMD Ryzen 7 dan SSD cepat, cocok untuk kerja kreatif, kuliah, hingga hiburan.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="{{ url('product-detail-page') }}"> <!-- Ganti URL sesuai halaman detail produk -->
                        <img src="{{ asset('images/printer.jpg') }}" class="d-block w-100" alt="Printer">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Printer Canon PIXMA MG2577s</h5>
                        <p>Nikmati kemudahan cetak, scan, dan copy di rumah atau kantor dengan printer hemat tinta dan hasil cetak tajam.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="{{ url('product-detail-page') }}"> <!-- Ganti URL sesuai halaman detail produk -->
                        <img src="{{ asset('images/meja_kursi_kantor.jpg') }}" class="d-block w-100" alt="MejaKursiKantor">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Set Meja & Kursi Kantor Ergonomis</h5>
                        <p>Didesain untuk produktivitas dan kenyamanan, cocok untuk ruang kerja profesional maupun home office.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="carousel-divider"></div>

        <div class="category-title">
            <h2>Kategori</h2>
        </div>

        <!-- Featured Categories -->
        <div class="category-container">
            <!-- Category 1 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/laptop.png') }}" alt="Elektronik & Gadget">
                <h3>Elektronik & Gadget</h3>
            </a>
            <!-- Category 2 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/baju.png') }}" alt="Pakaian & Aksesori">
                <h3>Pakaian & Aksesori</h3>
            </a>
            <!-- Category 3 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/sofa.png') }}" alt="Perabotan Rumah Tangga">
                <h3>Perabotan Rumah Tangga</h3>
            </a>
            <!-- Category 4 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/tas.png') }}" alt="Buku & Peralatan Sekolah">
                <h3>Buku, Alat Tulis, Peralatan Sekolah</h3>
            </a>
            <!-- Category 5 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/mainan.png') }}" alt="Hobi & Mainan">
                <h3>Hobi, Mainan, Koleksi</h3>
            </a>
            <!-- Category 6 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/bayi.png') }}" alt="Perlengkapan Bayi & Anak">
                <h3>Perlengkapan Bayi & Anak</h3>
            </a>
            <!-- Category 7 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/roda.png') }}" alt="Otomotif & Aksesori">
                <h3>Otomotif & Aksesori</h3>
            </a>
            <!-- Category 8 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/tenda.png') }}" alt="Perlengkapan Taman & Outdoor">
                <h3>Perlengkapan Taman & Outdoor</h3>
            </a>
            <!-- Category 9 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/kantor.png') }}" alt="Peralatan Kantor & Industri">
                <h3>Peralatan Kantor & Industri</h3>
            </a>
            <!-- Category 10 -->
            <a href="{{ url('kategori') }}" class="category-card">
                <img src="{{ asset('images/kategori/cermin.png') }}" alt="Kosmetik & Perawatan Diri">
                <h3>Kosmetik & Perawatan Diri</h3>
            </a>
        </div>

        <div class="populer-produk">
            <h2>Produk Terpopuler</h2>
        </div>
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
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <p>© 2024 Reusemart. All rights reserved.</p>
            </div>
            <div class="footer-middle">
                <p>Follow Us</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/facebook.png" alt="Facebook"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/twitter.png" alt="Twitter"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/instagram.png" alt="Instagram"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/pinterest.png" alt="Pinterest"></a>
                    <a href="#" class="social-icon"><img src="https://img.icons8.com/material/24/000000/youtube.png" alt="YouTube"></a>
                </div>
            </div>
        </div>
        <!-- Back to Top Button -->
        <div class="back-to-top">
            <a href="#top"><img src="https://img.icons8.com/ios-filled/50/000000/up.png" alt="Back to Top"></a>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

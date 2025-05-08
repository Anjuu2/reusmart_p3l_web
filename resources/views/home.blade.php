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
            margin-top: 20px;
            margin-left: 125px;
        }

        .populer-produk h2 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
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

    </main>

    <!-- Bootstrap JS and dependencies (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

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
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            padding: 20px 40px;
        }

        /* Kartu Produk */
        .product-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            text-decoration: none;
            color: inherit;
            border: 1px solid #e0e0e0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
            height: 400px;
        }

        .product-card:hover {
            transform: scale(1.05); /* Memperbesar produk sedikit saat hover */
        }

        /* Gambar Produk */
       .product-card img {
            /* width: 100%; */
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .product-card h4 {
            font-size: 16px;
            margin: 5px 0;
        }

        .product-card p {
            font-size: 14px;
            margin: 2px 0;
        }

        /* Informasi Produk */
        .product-info {
            margin-top: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Nama Kategori Produk */
        .product-category {
            font-size: 10px;
            color: #777;
            text-align: left;
        }

        /* Nama Produk */
        .product-name {
            font-size: 20px;
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
            margin-top: auto;
        }

        /* Harga Produk (Di kiri) */
        .price-container {
            flex: 1;
            text-align: left;
        }

        .current-price {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            flex-direction: column;
            margin-left: 10px;
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
            margin-right: 10px;
             width: 16px;  /* Menyesuaikan lebar gambar */
            height: 16px; /* Menyesuaikan tinggi gambar */
            object-fit: contain; /* Memastikan gambar tidak terdistorsi */
        }

        .add-to-cart:hover {
            background-color: #ACE1AF;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            padding: 20px 0;
            width: 100%;
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
                <!-- <input type="search" placeholder="Search for items..."> -->
                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Cari produk...">
                    <button id="search-button">Cari</button>
                </div>

                <!-- Icons -->
                <div class="icons">
                    <a href="#"><img src="https://img.icons8.com/material/24/000000/shopping-cart.png" alt="Cart"></a>
                    <a href="login"><img src="https://img.icons8.com/material/24/000000/user.png" alt="Account"></a>
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
            <a href="{{ url('kategori/1') }}" class="category-card">
                <h3>Elektronik & Gadget</h3>
            </a>
            <!-- Category 2 -->
            <a href="{{ url('kategori/2') }}" class="category-card">
                <h3>Pakaian & Aksesori</h3>
            </a>
            <!-- Category 3 -->
            <a href="{{ url('kategori/3') }}" class="category-card">
                <h3>Perabotan Rumah Tangga</h3>
            </a>
            <!-- Category 4 -->
            <a href="{{ url('kategori/4') }}" class="category-card">
                <h3>Buku, Alat Tulis, Peralatan Sekolah</h3>
            </a>
            <!-- Category 5 -->
            <a href="{{ url('kategori/5') }}" class="category-card">
                <h3>Hobi, Mainan, Koleksi</h3>
            </a>
            <!-- Category 6 -->
            <a href="{{ url('kategori/6') }}" class="category-card">
                <h3>Perlengkapan Bayi & Anak</h3>
            </a>
            <!-- Category 7 -->
            <a href="{{ url('kategori/7') }}" class="category-card">
                <h3>Otomotif & Aksesori</h3>
            </a>
            <!-- Category 8 -->
            <a href="{{ url('kategori/8') }}" class="category-card">
                <h3>Perlengkapan Taman & Outdoor</h3>
            </a>
            <!-- Category 9 -->
            <a href="{{ url('kategori/9') }}" class="category-card">
                <h3>Peralatan Kantor & Industri</h3>
            </a>
            <!-- Category 10 -->
            <a href="{{ url('kategori/10') }}" class="category-card">
                <h3>Kosmetik & Perawatan Diri</h3>
            </a>
        </div>

        <div class="carousel-divider"></div>

        <div class="product-section">
            <h2 style="text-align: center;">
                {{ isset($kategori) ? 'Kategori Barang ' . $kategori->nama_kategori : 'Seluruh Produk' }}
            </h2>

            <div class="product-container" id="product-container">
                @forelse($produk as $item)
                    <a href="{{ url('product/' . $item->id_barang) }}" class="product-card">
                        <img src="{{ asset('images/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}">
                        <div class="product-info">
                        <p class="product-category">{{ $item->kategori->nama_kategori ?? 'Kategori Tidak Ada' }}</p>
                        <h3 class="product-name">{{ $item->nama_barang }}</h3>
                        <!-- <div class="product-rating">
                            <span>★ ({{ rand(4,5) }}.{{ rand(0,9) }})</span>
                        </div> -->
                        <p class="product-status">{{ $item->status_barang }}</p>
                    </div>

                    <div class="product-price">
                        <div class="price-container">
                            <span class="current-price">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                        </div>
                        <div class="add-to-cart-container">
                            <button class="add-to-cart">
                                <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                Add
                            </button>
                        </div>
                    </div>
                </a>
            @empty
                <p>Tidak ada produk tersedia saat ini.</p>
            @endforelse
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
    <script>
    document.getElementById('search-button').addEventListener('click', function () {
        const query = document.getElementById('search-input').value.trim();

        if (query !== '') {
            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('product-container');
                    container.innerHTML = ''; // Kosongkan produk sebelumnya

                    if (data.length > 0) {
                        data.forEach(item => {
                            const card = document.createElement('a');
                            card.href = `/product/${item.id_barang}`;
                            card.classList.add('product-card');
                            card.innerHTML = `
                                <img src="/images/${item.foto_barang}" alt="${item.nama_barang}">
                                <div class="product-info">
                                    <p class="product-category">${item.kategori?.nama_kategori ?? 'Kategori Tidak Ada'}</p>
                                    <h3 class="product-name">${item.nama_barang}</h3>
                                    <p class="product-status">${item.status_barang}</p>
                                </div>
                                <div class="product-price">
                                    <div class="price-container">
                                        <span class="current-price">Rp${parseInt(item.harga_jual).toLocaleString('id-ID')}</span>
                                    </div>
                                    <div class="add-to-cart-container">
                                        <button class="add-to-cart">
                                            <img src="https://img.icons8.com/material/24/007848/shopping-cart.png" alt="Cart">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            `;
                            container.appendChild(card);
                        });
                    } else {
                        container.innerHTML = '<p>Tidak ada produk ditemukan.</p>';
                    }
                })
                .catch(err => {
                    console.error('Search error:', err);
                });
        }
    });

    // Tekan Enter juga bisa jalanin pencarian
    document.getElementById('search-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            document.getElementById('search-button').click();
        }
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ruang Diskusi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
        }

        header {
            background-color: #f4f4f4;
            padding: 15px 0;
            border-bottom: 1px solid #ccc;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo img {
            height: 40px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .cart-search {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .cart-search input[type="search"] {
            padding: 5px 10px;
        }

        .icons img {
            height: 24px;
        }

        .discussion-card {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .discussion-card .jawaban {
            margin-top: 10px;
            color: green;
        }

        .discussion-card .no-jawaban {
            margin-top: 10px;
            color: gray;
            font-style: italic;
        }

        .discussion-container {
            max-height: 600px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

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
        <div class="cart-search">
            <input type="search" placeholder="Search for items...">
            <div class="icons">
                <a href="#"><img src="https://img.icons8.com/material/24/000000/shopping-cart.png" alt="Cart"></a>
                <a href="{{ route('diskusi.index') }}"><img src="https://img.icons8.com/?size=100&id=123773&format=png&color=000000" alt="Diskusi"></a>
                <a href="{{ route('pembeli.profil') }}">
                    <img src="https://img.icons8.com/material/24/000000/user.png" alt="Account">
                </a>
            </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <h2 class="mb-4">Diskusi Produk</h2>

    {{-- Daftar diskusi --}}
    <div class="discussion-container">
        @forelse ($diskusi as $d)
            <div class="discussion-card">
                <strong>Pertanyaan:</strong>
                <p>{{ $d->pertanyaan }}</p>
                <div class="{{ $d->jawaban ? 'jawaban' : 'no-jawaban' }}">
                    @if ($d->jawaban)
                        <strong>Jawaban:</strong>
                        <p>{{ $d->jawaban }}</p>
                    @else
                        <em>Belum dijawab oleh admin</em>
                    @endif
                </div>
            </div>
        @empty
            <p>Belum ada diskusi untuk produk ini.</p>
        @endforelse
    </div>
</div>

</body>
</html>

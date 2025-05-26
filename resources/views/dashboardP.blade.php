<!-- ReUseMart - Dashboard Penitip -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penitip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgba(111, 143, 70, 1);
        }
        body {
            background-color: #f5f8f2;
            font-family: 'Segoe UI', sans-serif;
        }
        header {
            background-color: var(--primary-color);
            padding: 15px 20px;
            color: white;
        }
        .logo img {
            height: 50px;
            border-radius: 50%;
        }
        .title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .table thead {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        .status-btn {
            border: none;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 0.875rem;
        }
        .status-tersedia {
            background-color: #d4edda;
            color: #155724;
        }
        .status-terjual {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status-didonasikan {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-donasi {
            background-color: #dee2e6;
            color: #495057;
        }
        footer {
            background-color: #f4f4f4;
            padding: 10px 50px;  
            border-top: 1px solid rgba(111, 143, 70, 1);
            font-size: 14px;
            margin-top: 40px;
        }
        .footer-container {
            display: flex;
            justify-content: space-between;
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
    </style>
</head>
<body>

<header class="d-flex justify-content-between align-items-center">
    <div class="logo">
        <a href="{{ url('/') }}"><img src="{{ asset('images/logo2.png') }}" alt="Logo"></a>
    </div>
    <div class="title">Dashboard Penitip</div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin logout?')">Logout</button>
    </form>
</header>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('penitip.barang.index') }}" method="GET" class="d-flex" style="gap: 10px;">
            <input type="text" name="q" class="form-control" placeholder="Cari nama barang..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>
    </div>

    <h4 class="mb-3">Daftar Barang Titipan Anda</h4>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Barang</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Sisa Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $index => $barang)
                    <tr>
                        <td>{{ $barangs->firstItem() + $index }}</td>
                        <td>
                            <img src="{{ asset('images/barang/' . ($barang->fotoBarang->first()->nama_file ?? 'default.jpg')) }}" alt="Foto" class="img-thumbnail" style="width: 80px; cursor:pointer" data-bs-toggle="modal" data-bs-target="#modalDeskripsi{{ $barang->id_barang }}">
                        </td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>
                            @php
                                $status = strtolower($barang->status_barang);
                            @endphp
                            <span class="status-btn
                                {{ $status === 'tersedia' ? 'status-tersedia' : '' }}
                                {{ $status === 'terjual' ? 'status-terjual' : '' }}
                                {{ $status === 'didonasikan' ? 'status-didonasikan' : '' }}
                                {{ $status === 'barang untuk donasi' ? 'status-donasi' : '' }}">
                                {{ $status === 'barang untuk donasi' ? 'barang untuk donasi' : $barang->status_barang }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($barang->tanggal_masuk)->format('d M Y') }}</td>
                        <td>{{ $barang->tanggal_keluar ? \Carbon\Carbon::parse($barang->tanggal_keluar)->format('d M Y') : '-' }}</td>
                        <td>
                            @if($barang->status_barang === 'Tersedia')
                                @php
                                    $tanggalAkhir = \Carbon\Carbon::parse($barang->tanggal_akhir);
                                    $sisaHari = round(now()->diffInDays($tanggalAkhir, false));
                                @endphp
                                @if($sisaHari > 0)
                                    <span class="badge bg-success">{{ $sisaHari }} hari tersisa</span>
                                @elseif($sisaHari === 0)
                                    <span class="badge bg-warning text-dark">Hari terakhir!</span>
                                @else
                                    <span class="badge bg-danger">Terlambat {{ abs($sisaHari) }} hari</span>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($barang->status_barang === 'Tersedia')
                                @if(!$barang->status_perpanjangan && \Carbon\Carbon::parse($barang->tanggal_akhir)->isPast())
                                    <form action="{{ route('penitip.perpanjang', $barang->id_barang) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-primary">Perpanjang</button>
                                    </form>
                                @endif
                                <!-- <form action="{{ route('penitip.tarik', $barang->id_barang) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tarik barang ini?')">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">Tarik</button>
                                </form> -->
                            @elseif($barang->status_barang === 'Terjual')
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $barang->id_barang }}">Detail</button>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Deskripsi -->
                    <div class="modal fade" id="modalDeskripsi{{ $barang->id_barang }}" tabindex="-1" aria-labelledby="deskripsiLabel{{ $barang->id_barang }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="deskripsiLabel{{ $barang->id_barang }}">Deskripsi Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nama:</strong> {{ $barang->nama_barang }}</p>
                                    <p><strong>Harga Jual:</strong> Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
                                    <p><strong>Deskripsi:</strong><br>{{ $barang->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="modalDetail{{ $barang->id_barang }}" tabindex="-1" aria-labelledby="modalLabel{{ $barang->id_barang }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="modalLabel{{ $barang->id_barang }}">Detail Penjualan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nama:</strong> {{ $barang->nama_barang }}</p>
                                    <p><strong>Harga Jual:</strong> Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada barang titipan ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $barangs->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-left">
            <p>© 2025 ReUseMart. All rights reserved.</p>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

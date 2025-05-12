<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            text-decoration: none;
            color: #333;
            margin-bottom: 20px;
        }
        .back-btn img {
            width: 20px;
            margin-right: 6px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <!-- Tombol kembali -->
    <a href="{{ url()->previous() }}" class="back-btn">
        <img src="https://img.icons8.com/material-outlined/24/000000/left.png" alt="Back">
        Kembali
    </a>

    <h2 class="mb-4">Riwayat Pembelian</h2>

    @forelse ($transaksiList as $transaksi)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <strong>Tanggal:</strong> {{ $transaksi->tanggal_transaksi }}<br>
                <strong>Status:</strong> {{ $transaksi->status_transaksi }}<br>
                <strong>Total:</strong> Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($transaksi->detailTransaksi as $detail)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>{{ $detail->barang->nama_barang ?? 'Barang sudah dihapus' }}</strong><br>
                                </div>
                                <div class="text-end fw-bold text-success">
                                    Rp{{ number_format($detail->barang->harga_jual ?? $detail->sub_total, 0, ',', '.') }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            Belum ada transaksi yang tercatat.
        </div>
    @endforelse
</div>
</body>
</html>

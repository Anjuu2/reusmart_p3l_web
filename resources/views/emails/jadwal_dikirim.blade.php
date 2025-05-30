<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Dikirim</title>
</head>
<body>
    <h3>Halo,</h3>
    <p>Berikut adalah detail jadwal pengiriman/pengambilan untuk transaksi nomor: <strong>{{ $transaksi->id_transaksi }}</strong></p>

    <ul>
        <li><strong>Jenis Jadwal:</strong> {{ $jadwal->jenis_jadwal }}</li>
        <li><strong>Tanggal Jadwal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d/m/Y H:i') }}</li>
        <li><strong>Status Jadwal:</strong> {{ $jadwal->status_jadwal }}</li>
    </ul>

    <p>Terima kasih telah menggunakan layanan kami.</p>
</body>
</html>

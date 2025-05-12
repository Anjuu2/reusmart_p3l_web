<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            text-decoration: none;
            color: #333;
            margin-bottom: 15px;
        }
        .back-btn img {
            width: 20px;
            margin-right: 6px;
        }
    </style>
</head>
<body style="background-color: #f4f4f4; font-family: Arial, sans-serif;">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 bg-white rounded shadow p-4">

            <a href="{{ route('home') }}" class="back-btn">
                <img src="https://img.icons8.com/material-outlined/24/000000/left.png" alt="Back">
                Kembali
            </a>

            <div class="row align-items-center mb-4">
                <div class="col-md-1 text-center">
                    <img src="https://img.icons8.com/ios-glyphs/90/000000/user--v1.png" alt="User" class="profile-img">
                </div>
                <div class="col-md-8">
                    <h5 class="mb-0">{{ $pembeli->nama_pembeli }}</h5>
                    <small class="text-muted">{{ $pembeli->email }}</small>
                </div>
                <div class="col-md-3 text-end">
                    <a href="#" class="btn btn-primary">Edit</a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ $pembeli->nama_pembeli }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" value="{{ $pembeli->username }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No Telepon</label>
                    <input type="text" class="form-control" value="{{ $pembeli->notelp }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Poin</label>
                    <input type="text" class="form-control" value="{{ $pembeli->poin }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="{{ $pembeli->status_aktif ? 'Aktif' : 'Tidak Aktif' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email Aktif</label>
                    <input type="text" class="form-control" value="{{ $pembeli->email }}" disabled>
                </div>
            </div>

            
                    <div class="mt-4 text-end">
                <a href="{{ route('pembeli.history') }}" class="btn btn-outline-primary me-2">Lihat Riwayat Pembelian</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

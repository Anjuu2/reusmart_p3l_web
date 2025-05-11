<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Profil Pembeli</h2>
            <p class="text-muted">Informasi akun Anda</p>
        </div>

        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8">{{ $pembeli->nama_pembeli }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $pembeli->email }}</dd>

                    <dt class="col-sm-4">No Telepon</dt>
                    <dd class="col-sm-8">{{ $pembeli->notelp }}</dd>

                    <dt class="col-sm-4">Poin</dt>
                    <dd class="col-sm-8">{{ $pembeli->poin }}</dd>

                    <dt class="col-sm-4">Status Akun</dt>
                    <dd class="col-sm-8">
                        @if ($pembeli->status_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>
    </div>

</body>
</html>

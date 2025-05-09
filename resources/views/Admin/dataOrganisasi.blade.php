@extends('Admin.dashboard')
@section('isi')

<style>
    .table{
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: 15px;
    }

    td{
        border: 2px solid black;
    }

    .id{
        width: 5vw;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<div class="container mt-3 ms-0">
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search" style="width: 250px;">
        <button class="btn btn-outline-dark" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
</div>

<table class="table table-striped border-dark text-center mt-4 ms-2" id="akun-table">
    <thead class="table-dark">
        <tr>
            <th class="id">ID</th>
            <th>Nama Organisasi</th>
            <th>Alamat</th>
            <th>Status Aktif</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data will be inserted here by JavaScript -->
    </tbody>
</table>

<div class="modal fade" id="staticVerifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticVerifikasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5" id="staticVerifikasiLabel">Ingin Menonaktifkan Akun?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="acc">Nonaktifkan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5" id="staticUpdateLabel">Perbarui Data Organisasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                <strong>Masukkan Nama Organisasi Baru</strong>
                <input type="text" class="form-control" id="floatingNamaUpdate" placeholder="Masukkan Nama Organisasi Baru" required>
                </div>
                <div class="mb-3">
                <strong>Masukkan Alamat Baru</strong>
                <input type="text" class="form-control" id="floatingAlamatUpdate" placeholder="Masukkan Alamat Baru" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="acc">Ubah</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    // Fetch the Akun data from the API when the page loads
    window.addEventListener('DOMContentLoaded', function() {
        fetch('http://127.0.0.1:8000/api/OrganisasiIndex')
            .then(response => response.json())
            .then(data => {
                console.log(data);  // Debugging: Cek data yang diterima

                // Cek apakah data.accounts merupakan array
                const accounts = data.data || []; // Gunakan data.accounts jika data memiliki array langsung
                console.log(accounts);  // Cek apakah accounts berisi array

                const tbody = document.querySelector('#akun-table tbody');
                console.log(tbody);  // Cek apakah tbody ditemukan

                // Clear any existing rows
                tbody.innerHTML = '';

                // Loop melalui akun dan tambahkan ke tabel
                accounts.forEach(account => {
                    const row = document.createElement('tr');
                    console.log(account);  // Debugging: Cek apakah objek account benar

                    row.innerHTML = `
                        <td>${account.id_organisasi}</td>
                        <td>${account.nama_organisasi}</td>
                        <td>${account.alamat}</td>
                        <td>${account.status_aktif}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticUpdate" data-account-id="${account.id_organisasi}">Perbarui</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticVerifikasi" data-account-id="${account.id_organisasi}">Nonaktif</button>
                        </td>
                    `;
                    tbody.appendChild(row);

                    // Debugging: Cek apakah row sudah ditambahkan ke tbody
                    console.log(row);
                });
            })
            .catch(error => {
                console.error('Error fetching akun data:', error);
            });
    });

</script>

<!-- <script>
    $(document).ready(function() {
        $('#staticVerifikasi').on('hidden.bs.modal', function () {
            $(this).find('input[type="date"]').val('');
        });

        $('#btnTolak, #btnTerima').on('click', function() {
            $('#staticVerifikasi').find('input[type="date"]').val('');
        });
    });
</script> -->


<script>
let accountId = null;

// Correct modal ID selector
$('#staticVerifikasi').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);  // Button that triggered the modal
    accountId = button.data('account-id');  // Extract account ID
    console.log("Account ID set:", accountId);  // Debugging
});

// Event listener for updating the PIN
document.getElementById('acc').addEventListener('click', function () {
    const pin = document.querySelector("#floatingNumberPin").value;

    console.log("Account ID on button click:", accountId);  // Debugging

    if (accountId === null) {
        alert("Account ID is missing! Please try again.");
        return;
    }

    // Send the update request
    fetch(`http://127.0.0.1:8000/api/OrganisasiNonaktif/${accountId}`, {
        method: 'POST',
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json",
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            // Close the modal
            $('#staticPin').modal('hide');
            alert('Account Deleted!');
            // Optionally refresh or reload the table data
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to delete account Please try again.');
    });
});
</script>

<!-- Update Data -->
<script>
    let accountId = null;

// Correct modal ID selector
$('#staticPin').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);  // Button that triggered the modal
    accountId = button.data('account-id');  // Extract account ID
    console.log("Account ID set:", accountId);  // Debugging
});

// Event listener for updating the PIN
document.getElementById('acc').addEventListener('click', function () {
    const nama_organisasi = document.querySelector("#floatingNamaUpdate").value;
    const alamat = document.querySelector("#floatingAlamatUpdate").value;

    console.log("Account ID on button click:", accountId);  // Debugging

    if (accountId === null) {
        alert("Account ID is missing! Please try again.");
        return;
    }

    // Send the update request
    fetch(`http://127.0.0.1:8000/api/OrganisasiUpdate/${accountId}`, {
        method: 'POST',
        headers: {
            "Authorization": `Bearer ${localStorage.getItem('authToken')}`,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            nama_organisasi: nama_organisasi,,
            organisasi: organisasi
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            // Close the modal
            $('#staticPin').modal('hide');
            alert('PIN updated successfully!');
            // Optionally refresh or reload the table data
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update PIN. Please try again.');
    });
});
</script>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Reservasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Form Reservasi</h2>
        <form action="{{ route('reservasi.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="customer" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="customer" name="customer" value="{{ old('customer') }}" required>
                <div class="invalid-feedback">Harap isi nama lengkap Anda.</div>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                <div class="invalid-feedback">Harap isi tanggal yang valid.</div>
            </div>
            <div class="mb-3">
                <label for="no_polisi" class="form-label">Nomor Polisi</label>
                <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="{{ old('no_polisi') }}" required>
                <div class="invalid-feedback">Harap isi nomor polisi kendaraan.</div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Kirim Reservasi</button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>
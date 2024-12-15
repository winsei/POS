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
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                <div class="invalid-feedback">Harap isi nama lengkap Anda.</div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                <div class="invalid-feedback">Harap isi nomor telepon yang valid.</div>
            </div>
            <div class="mb-3">
                <label for="police_number" class="form-label">Nomor Polisi</label>
                <input type="text" class="form-control" id="police_number" name="police_number" value="{{ old('police_number') }}" required>
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
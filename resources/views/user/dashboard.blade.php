<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container">
            <!-- Logo and Title -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" width="40" height="40" class="me-2">
                <span class="fw-bold">Bengkel Betawi Racer</span>
            </a>

            <!-- Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reservasi') }}">Reservasi</a>
                    </li>
                    <!-- User Profile Dropdown -->
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('img/user.png') }}" alt="User" width="32" height="32"
                                class="rounded-circle me-2">
                            <span class="fw-bold">Hi, {{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var reservationModal = new bootstrap.Modal(document.getElementById('reservationSuccessModal'));
                reservationModal.show();
            });
        </script>
    @endif

    <!-- Pop Up Reservasi -->
    <div class="modal fade" id="reservationSuccessModal" tabindex="-1" aria-labelledby="reservationSuccessLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">TERIMAKASIH PESANAN ANDA AKAN KAMI PROSES</h5>
                    <button type="button" class="btn btn-danger mt-3" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Welcome Section -->
    <div class="container mt-4 text-center">
        <h1>Selamat Datang di Bengkel Betawi Racer</h1>
        <p>Kami siap melayani kebutuhan perawatan dan perbaikan motor Anda dengan sepenuh hati.</p>
        <img src="{{ asset('img/bengkel1.jpg') }}" class="img-fluid rounded shadow mt-3">
    </div>
    <!-- Services Section -->
    <div id="services" class="container mt-5">
        <h2 class="text-center mb-4">Layanan Kami</h2>
        <div class="row g-4">
            <!-- Service Cards -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Servis Motor Matic 125cc</h5>
                        <img src="{{ asset('img/Procfile.png') }}">
                        <p class="card-text">
                            - Ganti Oli<br>
                            - Ganti Oli Gardan<br>
                            - Isi Angin<br>
                            - Ganti Kampas Rem
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Servis Motor Matic 150cc</h5>
                        <img src="{{ asset('img/matic150.png') }}">
                        <p class="card-text">
                            - Ganti Oli<br>
                            - Ganti Oli Gardan<br>
                            - Isi Angin<br>
                            - Ganti Kampas Rem
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Servis Motor Bebek 125cc</h5>
                        <img src="{{ asset('img/bebek125cc.png') }}">
                        <p class="card-text">
                            - Ganti Oli<br>
                            - Ganti Oli Gardan<br>
                            - Isi Angin<br>
                            - Ganti Kampas Rem
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products" class="container mt-5">
        <h2 class="text-center mb-4">Produk Kami</h2>
        <div class="row g-4">
            <!-- Product Cards -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Oli Shell Advance</h5>
                        <img src="{{ asset('img/olishel.png') }}">
                        <h5 class="card-title">10-40w</h5>
                        <p class="card-text">Harga: Rp 50.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Oli Gardan</h5>
                        <img src="{{ asset('img/oligardan.png') }}">
                        <h5 class="card-title">Matic</h5>
                        <p class="card-text">Harga: Rp 15.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ban Motor</h5>
                        <img src="{{ asset('img/ban.png') }}">
                        <h5 class="card-title">120/80</h5>
                        <p class="card-text">Harga: Rp 375.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Contact Section -->
    <div id="contact" class="container mt-5">
        <h2 class="text-center mb-4">Kontak Kami</h2>
        <p class="text-center">Jl. Puncak Cikunir, RT.005/RW.015, Jakasampurna, Kec. Bekasi Bar., Kota Bks, Jawa Barat
            17133</p>
        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-outline-primary me-2">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="#" class="btn btn-outline-danger me-2">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="btn btn-outline-primary">
                <i class="bi bi-facebook"></i>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5">
        © 2024 Bengkel Betawi Racer. All Rights Reserved.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

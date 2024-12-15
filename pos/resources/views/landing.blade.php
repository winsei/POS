<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link ke CSS custom (jika perlu) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand">
                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" width="50" height="50"> Bengkel Betawi Racer
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#visi">Visi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#misi">Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sejarah">Sejarfh</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-black" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container mt-4">
        <!-- Teks Selamat Datang -->
        <div class="text-center mb-3">
            <h2>Selamat Datang di Bengkel Betawi Racer</h2>
        </div>

        <!-- Gambar -->
        <div class="text-center mb-4">
            <img src="{{ asset('img/bengkel1.jpg') }}" class="img-fluid rounded" alt="Banner Bengkel Betawi Racer" style="max-width: 600px;">
        </div>

        <!-- Deskripsi Singkat -->
        <div class="text-center">
            <p>
                Kami Merupakan bengkel motor yang berkomitmen untuk memastikan setiap motor yang diperbaiki kembali dalam kondisi prima. Mengutamakan kepuasan pelanggan, Bengkel Betawi Racer selalu berusaha memberikan pelayanan yang cepat, berkualitas, dan harga yang terjangkau.
            </p>
        </div>

        <!-- Visi -->
        <section id="visi" class="mt-5">
            <h3>Visi</h3>
            <p>Menjadi bengkel motor terdepan di Bekasi dalam memberikan pelayanan berkualitas dan kepuasan pelanggan yang tinggi melalui keahlian profesional dan inovasi.</p>
        </section>

        <!-- Misi -->
        <section id="misi" class="mt-5">
            <h3>Misi</h3>
            <ol>
                <li>Memberikan layanan perbaikan dan perawatan motor yang cepat, tepat, dan berkualitas tinggi.</li>
                <li>Menjaga kepuasan pelanggan melalui pelayanan yang ramah dan profesional.</li>
                <li>Menerapkan sistem manajemen yang efisien untuk mempercepat proses perbaikan dan meminimalkan waktu tunggu pelanggan.</li>
            </ol>
        </section>

        <!-- Sejarah -->
        <section id="sejarah" class="mt-5">
            <h3>Sejarah</h3>
            <p>Bengkel Betawi Racer didirikan pada tahun 2017 di Bekasi oleh sekelompok mekanik berpengalaman yang memiliki hasrat untuk memberikan layanan terbaik kepada para pengendara motor. Berawal dari sebuah bengkel kecil di kawasan Kranji, Bengkel Betawi Racer didirikan dengan tujuan utama untuk memenuhi kebutuhan masyarakat Bekasi akan layanan perbaikan motor yang andal dan terpercaya.</p>
        </section>

        <!-- Contact -->
        <section class="text-center my-5">
            <h3>Contact</h3>
            <p>Jl. Puncak Cikurir, RT.005/RW.015, Jakasampurna, Kec. Bekasi Bar., Kota Bks, Jawa Barat 17133</p>
            <div class="d-flex justify-content-center">
                <a href="#" class="mx-2"><img src="https://img.icons8.com/ios-glyphs/30/000000/facebook-new.png" alt="Facebook"></a>
                <a href="#" class="mx-2"><img src="https://img.icons8.com/ios-glyphs/30/000000/instagram-new.png" alt="Instagram"></a>
                <a href="#" class="mx-2"><img src="https://img.icons8.com/ios-glyphs/30/000000/whatsapp.png" alt="WhatsApp"></a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="py-3 text-center" style="background-color: white; color: black; border:1px black; ">
            <p class="mb-0">&copy; 2024 Bengkel Betawi Racer. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

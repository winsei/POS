<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .register-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }
        .register-container img.logo {
            width: 100px;
            height: auto;
            margin: 20px auto;
            display: block;
        }
        .form-control {
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
            border-radius: 8px;
            padding: 10px;
            font-size: 16px;
        }
        .footer-text {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .footer-text a {
            color: #007bff;
            text-decoration: none;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Logo -->
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="logo">

        <!-- Form Title -->
        <h3 class="text-center mb-4">Buat Akun Baru</h3>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name Input -->
            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama Anda" required>
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <!-- Confirm Password Input -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Masukkan ulang password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>

        <!-- Footer Text -->
        <div class="footer-text">
            <p>Sudah memiliki akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

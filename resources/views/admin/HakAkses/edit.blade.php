<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-POS | Bengkel Betawi Racer</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-bg: #f4f6f9;
            --sidebar-width: 250px;
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
        }
        
        body {
            background-color: var(--primary-bg);
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .sidebar-content {
            overflow-y: auto;
            flex-grow: 1;
            padding: 0 10px;
        }
        
        .brand-section {
            text-align: center;
            padding: 15px 10px;
            border-bottom: 1px solid #e9ecef;
            flex-shrink: 0;
        }
        
        .brand-title {
            font-size: 22px;
            font-weight: bold;
            color: var(--primary-color);
            margin-top: 10px;
        }
        
        .brand-logo {
            max-height: 80px;
            max-width: 120px;
            margin-bottom: 10px;
        }
        
        .nav-section-title {
            color: var(--secondary-color);
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-size: 0.75em;
            padding: 0 10px;
        }
        
        .nav-link {
            padding: 10px 15px;
            color: #666;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            font-size: 0.9em;
        }
        
        .nav-link i {
            margin-right: 10px;
            font-size: 1em;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(13, 110, 253, 0.1);
            color: var(--primary-color);
        }
        
        .logout-link {
            margin-top: auto;
            border-top: 1px solid #e9ecef;
            padding: 10px;
            flex-shrink: 0;
        }
        
        .logout-link .nav-link {
            color: #dc3545;
        }
        
        .logout-link .nav-link:hover {
            background-color: rgba(220, 53, 69, 0.1);
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            position: relative;
        }
        
        /* Rest of the previous CSS remains the same */
        .container {
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        
        .table {
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #dee2e6; /* Added border around the table */
        }
        
        .table th {
            background-color: #f8f9fa;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.9em;
            text-align: center; /* Center-align headers */
            vertical-align: middle; /* Vertically center header text */
            border: 1px solid #dee2e6; /* Border for header cells */
        }
        
        .table td {
            text-align: center; /* Center-align all table cells */
            vertical-align: middle; /* Vertically center cell content */
            border: 1px solid #dee2e6; /* Border for data cells */
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand-section">
            <img src="{{ asset('img/logo.jpg') }}" alt="Betawi Racer" class="brand-logo">
            <h1 class="brand-title">SI-POS</h1>
        </div>
        
        <div class="sidebar-content">
            <div class="nav flex-column nav-pills">
                <a href="#" class="nav-link active">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard
                </a>
                <div class="nav-section-title">Transaksi</div>
                <a href="{{ route('transaksi.index') }}" class="nav-link">
                    <i class="bi bi-wallet2"></i>
                    Kelola Transaksi
                </a>
                <div class="nav-section-title">Master Data</div>
                <a href="{{ route('barang.index') }}" class="nav-link">
                    <i class="bi bi-tools"></i>
                    Data Sparepart
                </a>
                <a href="{{ route('service.index') }}" class="nav-link">
                    <i class="bi bi-wrench"></i>
                    Data Service
                </a>
                
                <!-- Menu Data Users: Hanya Tampil untuk Admin -->
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('HakAkses.index') }}" class="nav-link">
                    <i class="bi bi-people"></i>
                    Data Users
                </a>
                @endif

                <!-- Menu Laporan Transaksi: Hanya Tampil untuk Admin atau Owner -->
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
                <div class="nav-section-title">Laporan</div>
                <a href="{{ route('laporan.bulanan') }}" class="nav-link">
                    <i class="bi bi-file-earmark-text"></i>
                    Laporan Transaksi
                </a>
                @endif
            </div>
        </div>
        
        <!-- Logout Link -->
        <div class="logout-link">
            <a href="{{ route('logout') }}" class="nav-link" 
               onclick="event.preventDefault(); 
               document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
    <div class="container">
        <h2>Edit User</h2>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit User Form -->
        <form action="{{ route('HakAkses.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
            </div>

            <!-- Password Field (Optional) -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <!-- Confirm Password Field (Required) -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <!-- Role Field -->
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="kasir" {{ $user->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('HakAkses.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
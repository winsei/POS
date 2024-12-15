<!-- resources/views/layouts/app.blade.php -->
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
            --primary-bg: #f8f9fa;
            --sidebar-width: 250px;
        }
        
        body {
            background-color: var(--primary-bg);
        }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        
        .brand-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .brand-logo {
            margin: 0 auto 30px;
            display: block;
            max-height: 120px;
            max-width: 100%;
            width: auto;
            height: auto;
        }
        
        .nav-link {
            padding: 10px 15px;
            color: #666;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }
        
        .top-bar {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .chart-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 90px;      
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h1 class="brand-title">SI-POS</h1>
        <img src="{{ asset('img/logo.jpg') }}" alt="Betawi Racer" class="brand-logo">
        
        <div class="nav flex-column nav-pills">
            <a href="#" class="nav-link active">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            <div class="nav-section-title">Transaksi</div>
            <a href="#" class="nav-link">
                <i class="bi bi-wallet2"></i>
                Kelola Transaksi
            </a>
            <div class="nav-section-title">Master Data</div>
            <a href="{{ route('barang.index') }}" class="nav-link">
                <i class="bi bi-tools"></i>
                Data Barang
            </a>
            <a href="{{ route('service.index') }}" class="nav-link">
                <i class="bi bi-wrench"></i>
                Data Service
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-people"></i>
                Data Customer
            </a>
            <div class="nav-section-title">Laporan</div>
            <a href="#" class="nav-link">
                <i class="bi bi-file-earmark-text"></i>
                Laporan Transaksi Keseluruhan
            </a>
        </div>
    </div>

<div class="container">
    <h1>Data Service</h1>

    <!-- Tombol Tambah Service -->
    <a href="{{ route('service.add') }}" class="btn btn-primary mb-3">Tambah Jasa</a>

    <!-- Tabel Service -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jasa</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->nama_jasa }}</td>
                <td>{{ number_format($service->harga, 2) }}</td>
                <td>
                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                    <form action="{{ route('service.delete', $service->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
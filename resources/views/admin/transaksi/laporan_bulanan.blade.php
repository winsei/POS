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

        .table-detail {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-detail th,
        .table-detail td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }

        .table-detail th {
            background-color: #f0f0f0;
            color: #333;
            font-weight: bold;
            text-align: left; /* Rata kiri khusus header */
            width: 30%; /* Lebar tetap untuk kolom header */
        }

        .table-detail td {
            text-align: left; /* Rata kiri khusus data */
            width: 70%; /* Lebar tetap untuk kolom header */
        }

        .table-detail tr:nth-child(odd) td {
            background-color: #fafafa;
        }

        .table-detail tr:nth-child(even) td {
            background-color: #ffffff;
        }

</style>

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
                <!-- Menu Transaksi: Hanya untuk Admin -->
                @if(auth()->user()->role !== 'owner')
                <div class="nav-section-title">Transaksi</div>
                <a href="{{ route('transaksi.index') }}" class="nav-link">
                    <i class="bi bi-wallet2"></i>
                    Kelola Transaksi
                </a>
                @endif

                <!-- Menu Transaksi: Hanya untuk Admin -->
                @if(auth()->user()->role !== 'owner')
                <div class="nav-section-title">Master Data</div>
                <a href="{{ route('barang.index') }}" class="nav-link">
                    <i class="bi bi-tools"></i>
                    Data Sparepart
                </a>
                @endif

                <!-- Menu Transaksi: Hanya untuk Admin -->
                @if(auth()->user()->role !== 'owner')
                <a href="{{ route('service.index') }}" class="nav-link">
                    <i class="bi bi-wrench"></i>
                    Data Service
                </a>
                @endif
                
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

                <!-- Menu Peramalan Transaksi: Hanya Tampil untuk  Owner -->
                @if(auth()->user()->role === 'owner')
                <div class="nav-section-title">Peramalan</div>
                <a href="#" class="nav-link">
                    <i class="bi bi-file-earmark-text"></i>
                    Peramalan
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
        
    </div>

    <div class="main-content">
    <div class="container">
        <h1>Laporan Pendapatan Bulanan</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>Pendapatan (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporanBulanan as $item)
                <tr>
                    <td>{{ $item->periode }}</td>
                    <td>{{ number_format($item->pendapatan, 2) }}</td>
                    <td>
                        <a href="{{ route('laporan.harian', $item->periode) }}" class="btn btn-info btn-sm">
                            Lihat Detail
                        </a>
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
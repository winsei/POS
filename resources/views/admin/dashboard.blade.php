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
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <div class="main-content">
        <div class="top-bar d-flex justify-content-between align-items-center bg-primary text-white p-3 rounded-3 shadow-sm">
            <div class="breadcrumb-container d-flex align-items-center">
                <!-- Logo or Icon if needed -->
                <i class="bi bi-house-door-fill fs-4 me-2"></i> <!-- Optional: add home icon -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Dashboard</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </nav>
            </div>
            
            <div class="user-info d-flex align-items-center">
                <img src="{{ asset('img/user.png') }}" alt="User" width="32" height="32"
                                class="rounded-circle me-2">
                            <span class="fw-bold">Hi, {{ Auth::user()->name }}</span>
            </div>
        </div>
    
        <!-- Main Content Section -->
        <div class="content-section mt-4">
            <div class="row">
        <div class="col-md-4">
            <div class="stat-card">
                <h6>Pendapatan Hari Ini</h6>
                <h3>Rp. {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h6>Service Hari Ini</h6>
                <h3>{{ $serviceHariIni }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h6>Item Terjual</h6>
                <h3>{{ $barangTerjualHariIni }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="chart-card">
            <h5>Total Service</h5>
            <canvas id="totalServiceChart" width="400" height="200"></canvas>
        </div>
    </div>
    <div class="col-12">
        <div class="chart-card">
            <h5>Item Terjual</h5>
            <canvas id="itemTerjualChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script>
    // Ambil data dari PHP
    var totalServiceData = {!! json_encode($totalServiceData) !!};
    var itemTerjualData = {!! json_encode($itemTerjualData) !!};

    console.log(totalServiceData); // Untuk memverifikasi data yang diterima
    console.log(itemTerjualData);  // Untuk memverifikasi data yang diterima

    // Total Service Chart
var ctx1 = document.getElementById('totalServiceChart').getContext('2d');
new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: totalServiceData.labels,  // Contoh: ['Jan', 'Feb', 'Mar', ...]
        datasets: [{
            label: 'Total Service',
            data: totalServiceData.values,  // Contoh: [20, 15, 30, ...]
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var ctx2 = document.getElementById('itemTerjualChart').getContext('2d');
new Chart(ctx2, {
    type: 'line',
    data: {
        labels: itemTerjualData.labels,  // Contoh: ['Jan', 'Feb', 'Mar', ...]
        datasets: [{
            label: 'Item Terjual',
            data: itemTerjualData.values,  // Contoh: [100, 150, 120, ...]
            fill: false,  // Menonaktifkan area di bawah garis
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderWidth: 3,
            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
            pointRadius: 5, // Ukuran titik data
            tension: 0.1  // Menambah kelengkungan pada garis
        }]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                mode: 'index', // Menampilkan tooltip untuk setiap titik data
                intersect: false
            },
            legend: {
                display: true
            }
        },
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>
</body>
</html>

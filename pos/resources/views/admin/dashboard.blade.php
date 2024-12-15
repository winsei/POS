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
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
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

        .nav-link:hover,
        .nav-link.active {
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chart-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </nav>
        </div>

        <!-- Stats Row -->
        <div class="row">
            <div class="col-md-4">
                <div class="stat-card">
                    <h6>Pendapatan Hari Ini</h6>
                    <h3>Rp. 5,000,000</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h6>Service Hari Ini</h6>
                    <h3>20</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h6>Item Terjual</h6>
                    <h3>150</h3>
                </div>
            </div>
        </div>

        <!-- Static Charts -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="chart-card">
                    <h5>Total Service</h5>
                    <img src="{{ asset('images/static-service-chart.png') }}" alt="Service Chart" class="w-100">
                </div>
            </div>
            <div class="col-12">
                <div class="chart-card">
                    <h5>Item Terjual</h5>
                    <img src="{{ asset('images/static-items-chart.png') }}" alt="Items Chart" class="w-100">
                </div>
            </div>
        </div>

        <!-- Laporan Transaksi Keseluruhan -->
        <div class="row">
            <div class="col-12">
                <div class="chart-card">
                    <h5>Laporan Transaksi Keseluruhan</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Total Pendapatan</th>
                                <th>Jumlah Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2024-11-18</td>
                                <td>Rp. 10,000,000</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2024-11-17</td>
                                <td>Rp. 8,500,000</td>
                                <td>40</td>
                            </tr>
                            <!-- Tambahkan data lainnya di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

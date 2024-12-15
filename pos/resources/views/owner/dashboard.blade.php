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

        .profile-dropdown img {
            width: 40px;
            height: 40px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h1 class="brand-title">SI-POS</h1>
        <img src="{{ asset('img/logo.jpg') }}" alt="Betawi Racer" class="brand-logo">
        
        <div class="nav flex-column nav-pills">
            <a href="#" class="nav-link">
                <i class="bi bi-cash-stack"></i>
                Laporan Keuangan
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-graph-up-arrow"></i>
                Peramalan
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Owner</li>
                </ol>
            </nav>

            <!-- Profile Section -->
            <div class="dropdown profile-dropdown">
                <a class="d-flex align-items-center text-decoration-none" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('img/user-avatar.jpg') }}" alt="User Avatar" class="rounded-circle me-2">
                    <span class="d-none d-sm-inline fw-semibold">John Doe</span>
                    <i class="bi bi-caret-down-fill ms-2"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>
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
    </div>
</body>
</html>

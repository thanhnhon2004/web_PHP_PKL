<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Admin - CameraMan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary: #E88F2A;
            --secondary: #FAF3EB;
            --light: #FFFFFF;
            --dark: #2B2825;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--dark);
            overflow-y: auto;
            z-index: 1000;
        }

        .admin-sidebar .logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .admin-sidebar .logo h4 {
            color: var(--primary);
            margin: 0;
            font-weight: 700;
        }

        .admin-sidebar .nav-link {
            color: #fff;
            padding: 0.8rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background-color: rgba(232, 143, 42, 0.1);
            border-left-color: var(--primary);
            color: var(--primary);
        }

        .admin-sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        .admin-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .admin-navbar {
            background-color: var(--light);
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .admin-main {
            padding: 0 2rem 2rem 2rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            border-radius: 10px 10px 0 0 !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #cf7d1f;
            border-color: #cf7d1f;
        }

        .table thead th {
            background-color: var(--secondary);
            color: var(--dark);
            border: none;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="logo">
            <h4><i class="fa fa-camera me-2"></i>CAMERAMAN</h4>
            <small class="text-white">Admin Panel</small>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="fas fa-box"></i>Quản lý sản phẩm
            </a>
            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i>Quản lý tài khoản
            </a>
            <a class="nav-link {{ request()->routeIs('admin.albums.*') ? 'active' : '' }}" href="{{ route('admin.albums.index') }}">
                <i class="fas fa-images"></i>Quản lý Album
            </a>
            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="fas fa-shopping-cart"></i>Quản lý đơn hàng
            </a>
            <hr class="my-3" style="border-color: rgba(255,255,255,0.1);">
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i>Xem trang chủ
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                    <i class="fas fa-sign-out-alt"></i>Đăng xuất
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- Top Navbar -->
        <div class="admin-navbar d-flex justify-content-between align-items-center">
            <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            <div>
                <span class="me-3">Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
                <i class="fas fa-user-circle fa-2x text-primary"></i>
            </div>
        </div>

        <!-- Page Content -->
        <div class="admin-main">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

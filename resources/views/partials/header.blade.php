<!-- Topbar Start -->
    <div class="container-fluid px-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Email Us</h6>
                        <span>info@example.com</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-primary border-inner py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <h1 class="m-0 text-uppercase text-white"><i class="fa fa-camera fs-1 text-dark me-3"></i>cameramam</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Call Us</h6>
                        <span>+012 345 6789</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="{{ route('home') }}" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white"><i class="fa fa-camera fs-1 text-primary me-3"></i>cameramam</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div>
                <div class="mx-auto" >
    <h2 class="m-0 text-uppercase text-white">cameramam</h2>
</div>

            </div>
    <!-- Menu chính căn giữa -->
    <div class="navbar-nav mx-auto py-0 text-center">
        <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">TRANG CHỦ</a>
        <a href="{{ route('products.index') }}" class="nav-item nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">SẢN PHẨM</a>
        <a href="{{ route('albums.index') }}" class="nav-item nav-link {{ request()->routeIs('albums.*') ? 'active' : '' }}">ALBUM</a>
        <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">LIÊN HỆ</a>
        <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">GIỚI THIỆU</a>
        @auth
        <a href="{{ route('cart.index') }}" class="nav-item nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}">
            GIỎ HÀNG
            @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
            <span class="badge bg-primary ms-1">{{ auth()->user()->cart->items->count() }}</span>
            @endif
        </a>
        <a href="{{ route('orders.index') }}" class="nav-item nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">ĐƠN HÀNG</a>
        @endauth
    </div>
     <!-- Thông báo đặt hàng thành công -->
    @php
        $notifications = session('notifications', []) ?? [];
    @endphp
    <div class="nav-item dropdown">
        <a href="#" class="nav-link position-relative" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell text-warning fs-4"></i>
            @if(count($notifications) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count($notifications) }}
            </span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="notificationDropdown" style="min-width: 320px; max-width: 350px;">
            <div class="p-3 border-bottom bg-light fw-bold">
                Thông báo hệ thống
            </div>
            @if(count($notifications) > 0)
                @foreach($notifications as $note)
                    <div class="dropdown-item d-flex align-items-start gap-2 py-2">
                        <i class="fas fa-info-circle text-primary mt-1"></i>
                        <div>
                            <div class="fw-semibold">{{ $note['title'] ?? 'Thông báo' }}</div>
                            <div class="small text-muted">{{ $note['message'] ?? '' }}</div>
                            @if(isset($note['time']))
                            <div class="small text-secondary mt-1">{{ $note['time'] }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="dropdown-divider my-0"></div>
                @endforeach
            @else
                <div class="dropdown-item text-center text-muted py-3">
                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                    Không có thông báo mới
                </div>
            @endif
        </div>
    </div>
    <!-- Login / Logout góc phải -->
    <div class="navbar-nav py-0">
        @guest
        <a href="{{ route('login') }}" class="nav-item nav-link">
            <i class="fas fa-sign-in-alt me-1"></i>Đăng nhập
        </a>
        <a href="{{ route('register') }}" class="nav-item nav-link">
            <i class="fas fa-user-plus me-1"></i>Đăng ký
        </a>
        @else
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user me-1"></i>{{ auth()->user()->name }}
            </a>
            <div class="dropdown-menu m-0">
                <a href="{{ route('profile.index') }}" class="dropdown-item">Tài khoản</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
            </div>
        </div>
        @endguest
    </div>
</div>
</nav>

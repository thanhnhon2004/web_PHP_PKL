<!-- Bootstrap 5.3.2 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Font Awesome 6.5.0 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    font-family: 'Segoe UI', sans-serif;
}
.left-side {
    background: url('/img/backgrounglogin.png') no-repeat center center/cover;
    position: relative;
    min-height: 100vh;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    overflow: hidden;
}
.left-side::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
}
.left-side .content {
    position: absolute;
    top: 150px;
    left: 100px;
    right: auto;
    z-index: 2;
    max-width: 400px;
    margin: 0;
    padding: 0 40px;
    transform: none;
}
.left-side h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    line-height: 1.15;
    color: #2fd6a7;
    text-shadow: 0 2px 16px rgba(0,0,0,0.18);
}
.left-side p {
    font-size: 1.1rem;
    color: #e0e0e0;
}
.login-card {
    background: rgba(255,255,255,0.98);
    padding: 15px 32px 0px 32px;
    border-radius: 28px;
    width: 100%;
    max-width: 400px;
    min-height: 420px;
    height: 690px;
    box-shadow: 0 8px 32px rgba(44,62,80,0.18), 0 1.5px 0 #2fd6a7;
    border: 2px solid #2fd6a7;
    transition: box-shadow 0.2s, border-color 0.2s;
}
.login-card:focus-within, .login-card:hover {
    box-shadow: 0 12px 40px rgba(44,62,80,0.25), 0 2px 0 #2fd6a7;
    border-color: #1f6f5d;
}
.btn-success {
    background-color: #1f6f5d;
    border: none;
}
.btn-success:hover {
    background-color: #155a4a;
}
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    color: #555;
    font-size: 14px;
    margin-bottom: 10px;
}
.back-btn:hover {
    color: #1f6f5d;
}
.small{
  margin-bottom: 0px !important;
}
</style>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- LEFT SIDE -->
        <div class="col-lg-8 d-none d-lg-flex left-side">
            <div class="content text-white">
                <h1>Chào mừng<br>thành viên mới!</h1>
                <p>Gia nhập cộng đồng Lumina Lens để khám phá, chia sẻ và phát triển nghệ thuật nhiếp ảnh cùng hàng ngàn thành viên khác.</p>
            </div>
        </div>
        <!-- RIGHT SIDE -->
        <div class="col-lg-4 col-12 d-flex justify-content-center align-items-center bg-light">
            <div class="login-card shadow">
                <a href="{{ url('/') }}" class="back-btn">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
                <h4 class="mb-2 text-success">Đăng ký tài khoản</h4>
                <p class="text-muted small">Vui lòng điền thông tin để tham gia cộng đồng</p>
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <form action="{{ route('register') }}" method="POST" autocomplete="off">
                  @csrf
                  <div class="mb-2">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên" required>
                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email" required>
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                    @error('phone')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="birthday" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday" value="{{ old('birthday') }}">
                    @error('birthday')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)" required>
                    @error('password')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
                  </div>
                  <button type="submit" class="btn btn-success w-100 rounded-pill mb-3">Đăng ký</button>
                </form>
                <p class="text-center  small">
                  Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
                </p>
            </div>
        </div>
    </div>
</div>

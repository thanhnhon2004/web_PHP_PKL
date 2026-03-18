<!-- Bootstrap 5.3.2 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Font Awesome 6.5.0 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Trang login độc lập, không header/footer -->
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
    padding: 36px 32px 32px 32px;
    border-radius: 28px;
    width: 100%;
    max-width: 400px;
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
    margin-bottom: 15px;
}
.back-btn:hover {
    color: #1f6f5d;
}
</style>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- LEFT SIDE -->
        <div class="col-lg-8 d-none d-lg-flex left-side">
            <div class="content text-white">
                <h1>Lưu giữ từng<br>khoảnh khắc nghệ thuật</h1>
                <p>Khơi nguồn sáng tạo cùng Lumina Lens — Nơi mỗi bức ảnh là một câu chuyện độc bản.</p>
            </div>
        </div>
        <!-- RIGHT SIDE -->
        <div class="col-lg-4 col-12 d-flex justify-content-center align-items-center bg-light">
            <div class="login-card shadow">
                <a href="{{ url('/') }}" class="back-btn">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
                <h4 class="mb-2 text-success">Chào mừng trở lại</h4>
                <p class="text-muted small">Vui lòng đăng nhập để tiếp tục sáng tạo</p>
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif
                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                  @csrf
                  <div class="mb-3">
                      <label class="form-label small">Địa chỉ email</label>
                      <div class="input-group">
                          <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="name@email.com" required>
                      </div>
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label class="form-label small">Mật khẩu</label>
                      <div class="input-group">
                          <span class="input-group-text"><i class="fa fa-lock"></i></span>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required>
                      </div>
                      @error('password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                      <div>
                          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> <small>Ghi nhớ đăng nhập</small>
                      </div>
                      <a href="#" class="small text-danger">Quên mật khẩu?</a>
                  </div>
                  <button type="submit" class="btn btn-success w-100 rounded-pill mb-3">
                      Đăng nhập ngay
                  </button>
                  <p class="text-center mt-3 small">
                      Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
                  </p>
                  <p>tài khoản khách: thanhnhon2k4@gmail.com <br>
                        mật khẩu: 123456 <br>
                        tài khoản admin: admin@cameraman.com <br>
                        mk: admin123
                </p>
                </form>
            </div>
        </div>
    </div>
</div>



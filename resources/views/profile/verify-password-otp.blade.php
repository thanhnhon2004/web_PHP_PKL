@extends('layout.main')
@section('noidung')
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Xác thực đổi mật khẩu</h1>
                <a href="{{ route('home') }}" class="text-white">Trang chủ</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="{{ route('profile.index') }}" class="text-white">Tài khoản</a>
                <i class="far fa-square text-primary px-2"></i>
                <span class="text-white">Xác thực OTP</span>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <style>
        .otp-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .otp-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .otp-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #E88F2A 0%, #cf7d1f 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 40px;
            color: white;
        }
        
        .otp-inputs {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 2rem 0;
        }
        
        .otp-input {
            width: 60px;
            height: 60px;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .otp-input:focus {
            border-color: #E88F2A;
            outline: none;
            box-shadow: 0 0 0 3px rgba(232, 143, 42, 0.1);
        }
        
        .timer {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            color: #E88F2A;
            margin: 1rem 0;
        }
        
        .resend-btn {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .resend-btn button {
            background: none;
            border: none;
            color: #E88F2A;
            text-decoration: underline;
            cursor: pointer;
            font-size: 14px;
        }
        
        .resend-btn button:disabled {
            color: #999;
            cursor: not-allowed;
            text-decoration: none;
        }
        
        .info-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 1.5rem 0;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>

    <div class="container mb-5">
        <div class="otp-container">
            <div class="otp-header">
                <div class="otp-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="mb-2">Xác thực đổi mật khẩu</h3>
                <p class="text-muted">
                    Để bảo mật tài khoản, chúng tôi đã gửi mã OTP gồm 6 số đến email<br>
                    <strong>{{ session('change_password_email') }}</strong>
                </p>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            @endif

            <form action="{{ route('profile.password.verify') }}" method="POST" id="otpForm">
                @csrf
                
                <div class="otp-inputs">
                    <input type="text" maxlength="1" class="otp-input form-control" name="otp[]" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-input form-control" name="otp[]" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-input form-control" name="otp[]" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-input form-control" name="otp[]" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-input form-control" name="otp[]" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-input form-control" name="otp[]" autocomplete="off" required>
                </div>

                <div class="timer" id="timer">
                    <i class="far fa-clock me-2"></i>
                    <span id="countdown">10:00</span>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-lg">
                    <i class="fas fa-check me-2"></i>Xác thực và đổi mật khẩu
                </button>

                <div class="resend-btn">
                    <p class="text-muted mb-2">Không nhận được mã?</p>
                    <button type="button" id="resendBtn" onclick="resendOTP()" disabled>
                        <i class="fas fa-redo me-1"></i>Gửi lại mã OTP (<span id="resendTimer">60</span>s)
                    </button>
                </div>
            </form>

            <div class="info-box">
                <strong>⚠️ Lưu ý bảo mật:</strong><br>
                • Mã OTP xác thực đổi mật khẩu có hiệu lực trong 10 phút<br>
                • Không chia sẻ mã này với bất kỳ ai<br>
                • Nếu bạn không yêu cầu đổi mật khẩu, vui lòng bỏ qua email này
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại trang cá nhân
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript for OTP Input -->
    <script>
        // Auto focus và auto submit
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                const val = this.value;
                
                // Chỉ cho phép số
                this.value = val.replace(/[^0-9]/g, '');
                
                // Tự động chuyển sang ô tiếp theo
                if (this.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                
                // Auto submit khi đủ 6 số
                const allFilled = Array.from(inputs).every(input => input.value !== '');
                if (allFilled) {
                    document.getElementById('otpForm').submit();
                }
            });
            
            // Xử lý backspace
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
            
            // Xử lý paste
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');
                
                for (let i = 0; i < pasteData.length && index + i < inputs.length; i++) {
                    inputs[index + i].value = pasteData[i];
                }
                
                if (index + pasteData.length < inputs.length) {
                    inputs[index + pasteData.length].focus();
                }
            });
        });
        
        // Focus vào ô đầu tiên
        inputs[0].focus();
        
        // Countdown timer (10 phút)
        let timeLeft = 600;
        const countdownElement = document.getElementById('countdown');
        
        const countdownTimer = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdownTimer);
                countdownElement.textContent = 'Hết hạn';
                countdownElement.parentElement.classList.add('text-danger');
            } else {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                timeLeft--;
            }
        }, 1000);
        
        // Resend OTP timer (60 giây)
        let resendTimeLeft = 60;
        const resendBtn = document.getElementById('resendBtn');
        const resendTimerElement = document.getElementById('resendTimer');
        
        const resendTimer = setInterval(() => {
            if (resendTimeLeft <= 0) {
                clearInterval(resendTimer);
                resendBtn.disabled = false;
                resendBtn.innerHTML = '<i class="fas fa-redo me-1"></i>Gửi lại mã OTP';
            } else {
                resendTimerElement.textContent = resendTimeLeft;
                resendTimeLeft--;
            }
        }, 1000);
        
        // Resend OTP function
        function resendOTP() {
            if (resendBtn.disabled) return;
            
            resendBtn.disabled = true;
            resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang gửi...';
            
            fetch('{{ route("profile.password.resend") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ Mã OTP mới đã được gửi đến email của bạn!');
                    
                    // Reset timers
                    timeLeft = 600;
                    resendTimeLeft = 60;
                    
                    // Clear inputs
                    inputs.forEach(input => input.value = '');
                    inputs[0].focus();
                } else {
                    alert('❌ Có lỗi xảy ra: ' + (data.message || 'Vui lòng thử lại'));
                    resendBtn.disabled = false;
                    resendBtn.innerHTML = '<i class="fas fa-redo me-1"></i>Gửi lại mã OTP';
                }
            })
            .catch(error => {
                alert('❌ Có lỗi xảy ra. Vui lòng thử lại!');
                resendBtn.disabled = false;
                resendBtn.innerHTML = '<i class="fas fa-redo me-1"></i>Gửi lại mã OTP';
            });
        }
    </script>
@endsection

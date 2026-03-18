<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã OTP xác thực</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #E88F2A 0%, #cf7d1f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .content p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 30px 0;
        }
        .otp-box {
            background-color: #f9f9f9;
            border: 2px dashed #E88F2A;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 42px;
            font-weight: bold;
            color: #E88F2A;
            letter-spacing: 8px;
            margin: 0;
            font-family: 'Courier New', monospace;
        }
        .otp-label {
            font-size: 14px;
            color: #777;
            margin-top: 10px;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            color: #856404;
            text-align: left;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px 30px;
            text-align: center;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #e0e0e0;
        }
        .footer a {
            color: #E88F2A;
            text-decoration: none;
        }
        .icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">🔐</div>
            <h1>Xác thực tài khoản</h1>
            <p>Camera Man - Chuyên nghiệp & Uy tín</p>
        </div>
        
        <div class="content">
            <p>Chào bạn,</p>
            <p>Bạn đã yêu cầu xác thực email để hoàn tất đăng ký tài khoản tại <strong>Camera Man</strong>.</p>
            <p>Vui lòng sử dụng mã OTP dưới đây để xác thực:</p>
            
            <div class="otp-box">
                <p class="otp-code">{{ $otp }}</p>
                <p class="otp-label">Mã OTP có hiệu lực trong 10 phút</p>
            </div>
            
            <div class="warning">
                <strong>⚠️ Lưu ý bảo mật:</strong><br>
                • Không chia sẻ mã này với bất kỳ ai<br>
                • Camera Man sẽ không bao giờ yêu cầu mã OTP qua điện thoại<br>
                • Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email
            </div>
            
            <p style="margin-top: 30px; color: #999; font-size: 14px;">
                Nếu bạn gặp vấn đề, vui lòng liên hệ với chúng tôi qua email hỗ trợ.
            </p>
        </div>
        
        <div class="footer">
            <p>© 2026 Camera Man. All rights reserved.</p>
            <p>
                <a href="{{ config('app.url') }}">Trang chủ</a> | 
                <a href="{{ config('app.url') }}/contact">Liên hệ</a>
            </p>
        </div>
    </div>
</body>
</html>

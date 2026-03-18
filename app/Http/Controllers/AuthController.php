<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\OTPService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $userService;
    protected $otpService;

    public function __construct(UserService $userService, OTPService $otpService)
    {
        $this->userService = $userService;
        $this->otpService = $otpService;
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
        ]);

        // Lưu thông tin đăng ký vào session
        session([
            'registration_data' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
            ],
            'registration_email' => $request->email,
        ]);

        // Gửi OTP qua email
        try {
            $this->otpService->generateAndSendOTP($request->email);
            return redirect()->route('verify.otp.form')->with('success', 'Mã OTP đã được gửi đến email của bạn!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()])->withInput();
        }
    }

    // Hiển thị form nhập OTP
    public function showVerifyOTPForm()
    {
        if (!session('registration_email')) {
            return redirect()->route('register')->withErrors(['email' => 'Vui lòng đăng ký trước.']);
        }
        
        return view('auth.verify-otp');
    }

    // Xác thực OTP
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric|digits:1',
        ]);

        $email = session('registration_email');
        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'Phiên đăng ký đã hết hạn.']);
        }

        $otp = implode('', $request->otp);
        
        // Xác thực OTP
        if (!$this->otpService->verifyOTP($email, $otp)) {
            return back()->with('error', 'Mã OTP không chính xác hoặc đã hết hạn!');
        }

        // Tạo tài khoản sau khi xác thực thành công
        $registrationData = session('registration_data');
        
        $user = $this->userService->register([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => Hash::make($registrationData['password']),
            'phone' => $registrationData['phone'],
            'birthday' => $registrationData['birthday'],
            'role_id' => 2, // User role
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Xóa session
        session()->forget(['registration_data', 'registration_email']);

        // Đăng nhập tự động
        Auth::login($user);
        
        return redirect()->route('home')->with('success', 'Đăng ký thành công! Chào mừng bạn đến với Camera Man.');
    }

    // Gửi lại OTP
    public function resendOTP(Request $request)
    {
        $email = session('registration_email');
        
        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Phiên đăng ký đã hết hạn.'
            ], 400);
        }

        try {
            $this->otpService->resendOTP($email);
            return response()->json([
                'success' => true,
                'message' => 'Mã OTP mới đã được gửi!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            
            // Kiểm tra role để chuyển hướng
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}

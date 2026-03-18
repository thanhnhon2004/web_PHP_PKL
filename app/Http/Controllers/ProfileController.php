<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\OrderService;
use App\Services\OTPService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\User;

class ProfileController extends Controller
{
    protected $userService;
    protected $orderService;
    protected $otpService;

    public function __construct(UserService $userService, OrderService $orderService, OTPService $otpService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->otpService = $otpService;
    }

    // Hiển thị trang profile
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $addresses = $user->addresses;
        $orders = $user->orders()->with(['items.product'])->latest()->paginate(4);
        
        return view('profile.index', compact('user', 'addresses', 'orders'));
    }

    // Cập nhật thông tin cá nhân
    public function updateInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'birthday']);
        
        $this->userService->updateProfile(Auth::id(), $data);

        return redirect()->route('profile.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    // Đổi mật khẩu - Bước 1: Gửi OTP
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng!');
        }

        // Lưu thông tin đổi mật khẩu vào session
        session([
            'change_password_data' => [
                'user_id' => $user->id,
                'new_password' => $request->password,
            ],
            'change_password_email' => $user->email,
        ]);

        // Gửi OTP qua email
        try {
            $this->otpService->generateAndSendOTP($user->email);
            return redirect()->route('profile.password.verify.form')
                ->with('success', 'Mã OTP xác thực đã được gửi đến email của bạn!');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể gửi email xác thực. Vui lòng thử lại!');
        }
    }

    // Hiển thị form nhập OTP đổi mật khẩu
    public function showPasswordOTPForm()
    {
        if (!session('change_password_email')) {
            return redirect()->route('profile.index')->with('error', 'Phiên đổi mật khẩu đã hết hạn.');
        }
        
        return view('profile.verify-password-otp');
    }

    // Xác thực OTP và đổi mật khẩu - Bước 2
    public function verifyPasswordOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric|digits:1',
        ]);

        $email = session('change_password_email');
        if (!$email) {
            return redirect()->route('profile.index')->with('error', 'Phiên đổi mật khẩu đã hết hạn.');
        }

        $otp = implode('', $request->otp);
        
        // Xác thực OTP
        if (!$this->otpService->verifyOTP($email, $otp)) {
            return back()->with('error', 'Mã OTP không chính xác hoặc đã hết hạn!');
        }

        // Lấy thông tin từ session
        $changePasswordData = session('change_password_data');
        
        // Cập nhật mật khẩu mới
        $this->userService->updateProfile($changePasswordData['user_id'], [
            'password' => $changePasswordData['new_password']
        ]);

        // Xóa session
        session()->forget(['change_password_data', 'change_password_email']);

        return redirect()->route('profile.index')
            ->with('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại với mật khẩu mới.');
    }

    // Gửi lại OTP cho đổi mật khẩu
    public function resendPasswordOTP(Request $request)
    {
        $email = session('change_password_email');
        
        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Phiên đổi mật khẩu đã hết hạn.'
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

    // Thêm địa chỉ mới
    public function addAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
        ]);

        /** @var User $user */
        $user = Auth::user();

        Address::create([
            'user_id' => $user->id,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.index')->with('success', 'Thêm địa chỉ thành công!');
    }

    // Cập nhật địa chỉ
    public function updateAddress(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|string|max:500',
        ]);
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->address = $request->address;
        $address->save();
        return redirect()->route('profile.index')->with('success', 'Cập nhật địa chỉ thành công!');
    }

    // Xóa địa chỉ
    public function deleteAddress($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->delete();

        return redirect()->route('profile.index')->with('success', 'Xóa địa chỉ thành công!');
    }
}

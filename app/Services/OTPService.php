<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Carbon\Carbon;

/**
 * OTPService - Xử lý logic OTP cho xác thực email
 * Áp dụng Single Responsibility Principle (SRP)
 */
class OTPService
{
    /**
     * Tạo và gửi OTP qua email
     * 
     * @param string $email
     * @return string OTP code
     */
    public function generateAndSendOTP(string $email): string
    {
        // Tạo mã OTP 6 số ngẫu nhiên
        $otp = $this->generateOTPCode();
        
        // Lưu OTP vào session hoặc database tạm
        session([
            'otp_' . $email => [
                'code' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10), // Hết hạn sau 10 phút
            ]
        ]);
        
        // Gửi email
        try {
            Mail::to($email)->send(new OTPMail($otp));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send OTP email: ' . $e->getMessage());
            throw new \Exception('Không thể gửi email. Vui lòng kiểm tra lại địa chỉ email.');
        }
        
        return $otp;
    }
    
    /**
     * Xác thực OTP
     * 
     * @param string $email
     * @param string $inputOtp
     * @return bool
     */
    public function verifyOTP(string $email, string $inputOtp): bool
    {
        $sessionKey = 'otp_' . $email;
        $otpData = session($sessionKey);
        
        if (!$otpData) {
            return false;
        }
        
        // Kiểm tra hết hạn
        if (Carbon::now()->greaterThan($otpData['expires_at'])) {
            session()->forget($sessionKey);
            return false;
        }
        
        // Kiểm tra mã OTP
        if ($otpData['code'] !== $inputOtp) {
            return false;
        }
        
        // Xóa OTP sau khi xác thực thành công
        session()->forget($sessionKey);
        
        return true;
    }
    
    /**
     * Cập nhật trạng thái email đã xác thực cho user
     * 
     * @param int $userId
     * @return void
     */
    public function markEmailAsVerified(int $userId): void
    {
        User::where('id', $userId)->update([
            'email_verified_at' => Carbon::now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
    }
    
    /**
     * Tạo mã OTP 6 số
     * 
     * @return string
     */
    protected function generateOTPCode(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
    
    /**
     * Kiểm tra OTP có hết hạn không
     * 
     * @param string $email
     * @return bool
     */
    public function isOTPExpired(string $email): bool
    {
        $sessionKey = 'otp_' . $email;
        $otpData = session($sessionKey);
        
        if (!$otpData) {
            return true;
        }
        
        return Carbon::now()->greaterThan($otpData['expires_at']);
    }
    
    /**
     * Gửi lại OTP (resend)
     * 
     * @param string $email
     * @return string
     */
    public function resendOTP(string $email): string
    {
        // Xóa OTP cũ
        session()->forget('otp_' . $email);
        
        // Tạo và gửi OTP mới
        return $this->generateAndSendOTP($email);
    }
}

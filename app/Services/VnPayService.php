<?php

namespace App\Services;

use App\Repositories\Interfaces\PaymentServiceInterface;

class VnPayService implements PaymentServiceInterface
{
    /**
     * Tạo URL thanh toán VNPay
     */
    public function createPayment($order)
    {
        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_Url = config('vnpay.url');
        $vnp_Returnurl = config('vnpay.return_url');

        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = "Thanh toan don hang #" . $order->id;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = intval($order->total_price * 100); // VNPay yêu cầu amount in đơn vị nhỏ nhất (xu)
        $vnp_Locale = "vn";
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);
        $query = http_build_query($inputData);
        $vnpSecureHash = hash_hmac('sha512', $query, $vnp_HashSecret);

        return $vnp_Url . "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;
    }

    /**
     * Xác minh response từ VNPay
     */
    public function verifyPayment($data)
    {
        $vnp_HashSecret = config('vnpay.hash_secret');

        // Lấy chữ ký từ response
        $vnp_SecureHash = $data['vnp_SecureHash'] ?? null;

        if (!$vnp_SecureHash) {
            return [
                'success' => false,
                'message' => 'Thiếu mã xác thực'
            ];
        }

        // Xóa tham số vnp_SecureHash khỏi dữ liệu
        $inputData = $data;
        unset($inputData['vnp_SecureHash']);
        
        // Sắp xếp theo alphabet
        ksort($inputData);
        
        // Tạo query string
        $hashData = implode('&', array_map(function ($key, $value) {
            return urlencode($key) . '=' . urlencode($value);
        }, array_keys($inputData), $inputData));

        // Tạo hash mới
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // Xác minh chữ ký
        if ($secureHash !== $vnp_SecureHash) {
            return [
                'success' => false,
                'message' => 'Chữ ký không hợp lệ'
            ];
        }

        // Kiểm tra mã phản hồi
        $responseCode = $data['vnp_ResponseCode'] ?? null;
        
        if ($responseCode === '00') {
            return [
                'success' => true,
                'message' => 'Thanh toán thành công',
                'transactionNo' => $data['vnp_TransactionNo'] ?? null,
                'transactionDate' => $data['vnp_PayDate'] ?? null,
                'amount' => isset($data['vnp_Amount']) ? intval($data['vnp_Amount']) / 100 : null
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Thanh toán thất bại - Mã lỗi: ' . $responseCode,
                'responseCode' => $responseCode
            ];
        }
    }
}
<?php

namespace App\Repositories\Interfaces;

interface PaymentServiceInterface
{
    /**
     * Tạo URL thanh toán
     */
    public function createPayment($order);

    /**
     * Xác minh response từ payment gateway
     */
    public function verifyPayment($data);
}

<?php

namespace App\Http\Controllers;
use App\Services\VnPayService;
use App\Services\OrderService;
use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $vnpay;
    protected $orderService;

    public function __construct(VnPayService $vnpay, OrderService $orderService)
    {
        $this->vnpay = $vnpay;
        $this->orderService = $orderService;
    }

    /**
     * Chuyển hướng đến trang thanh toán VNPay
     */
    public function pay($orderId)
    {
        try {
            $order = Order::find($orderId);
            
            if (!$order) {
                return redirect()->route('orders.index')->with('error', 'Đơn hàng không tồn tại');
            }

            // Kiểm tra quyền sở hữu đơn hàng
            if ($order->user_id !== Auth::id()) {
                return redirect()->route('orders.index')->with('error', 'Bạn không có quyền truy cập đơn hàng này');
            }

            // Kiểm tra trạng thái đơn hàng
            if (!$order->isPending()) {
                return redirect()->route('orders.show', $order->id)->with('error', 'Đơn hàng này không thể thanh toán');
            }

            // Log payment initiation
            PaymentHistory::create([
                'order_id' => $order->id,
                'method' => 'vnpay',
                'status' => 'pending',
                'amount' => $order->total_price,
                'response_message' => 'Payment initiated',
            ]);

            $paymentUrl = $this->vnpay->createPayment($order);
            return redirect($paymentUrl);
            
        } catch (\Exception $e) {
            Log::error('Payment initiation error: ' . $e->getMessage());
            return redirect()->route('orders.index')->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Xử lý callback từ VNPay
     */
    public function return(Request $request)
    {
        try {
            // Xác minh chữ ký từ VNPay
            $verificationResult = $this->vnpay->verifyPayment($request->all());
            
            $orderId = $request->vnp_TxnRef;
            $order = Order::find($orderId);

            if (!$order) {
                return view('payment.result', [
                    'success' => false,
                    'message' => 'Đơn hàng không tồn tại',
                    'order' => null
                ]);
            }

            if (!$verificationResult['success']) {
                // Log failed payment
                PaymentHistory::create([
                    'order_id' => $order->id,
                    'transaction_no' => $request->vnp_TransactionNo ?? null,
                    'method' => 'vnpay',
                    'status' => 'failed',
                    'amount' => isset($request->vnp_Amount) ? intval($request->vnp_Amount) / 100 : $order->total_price,
                    'response_code' => $request->vnp_ResponseCode ?? null,
                    'response_message' => $verificationResult['message'],
                    'metadata' => $request->all(),
                ]);

                return view('payment.result', [
                    'success' => false,
                    'message' => $verificationResult['message'],
                    'order' => $order
                ]);
            }

            // Cập nhật trạng thái đơn hàng
            DB::beginTransaction();
            try {
                $order->update([
                    'status' => 'paid',
                    'payment_status' => 'completed',
                    'transaction_no' => $request->vnp_TransactionNo ?? null,
                    'transaction_date' => $request->vnp_PayDate ?? null
                ]);

                // Log successful payment
                PaymentHistory::create([
                    'order_id' => $order->id,
                    'transaction_no' => $request->vnp_TransactionNo ?? null,
                    'method' => 'vnpay',
                    'status' => 'completed',
                    'amount' => isset($request->vnp_Amount) ? intval($request->vnp_Amount) / 100 : $order->total_price,
                    'response_code' => $request->vnp_ResponseCode ?? null,
                    'response_message' => 'Payment successful',
                    'metadata' => $request->all(),
                ]);

                DB::commit();

                return view('payment.result', [
                    'success' => true,
                    'message' => 'Thanh toán thành công',
                    'order' => $order
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Payment update error: ' . $e->getMessage());
                
                return view('payment.result', [
                    'success' => false,
                    'message' => 'Lỗi cập nhật trạng thái thanh toán: ' . $e->getMessage(),
                    'order' => $order
                ]);
            }
            
        } catch (\Exception $e) {
            Log::error('Payment processing error: ' . $e->getMessage());
            
            return view('payment.result', [
                'success' => false,
                'message' => 'Lỗi xử lý thanh toán: ' . $e->getMessage()
            ]);
        }
    }
}


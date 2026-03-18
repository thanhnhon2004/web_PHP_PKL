<?php
namespace App\Http\Controllers;
use App\Services\OrderService;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderSuccessMail;

class OrderController extends Controller
{
    protected $orderService;
    protected $cartService;

    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }

    // Hiển thị danh sách đơn hàng của user
    public function index()
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        return view('orders.index', compact('orders'));
    }

    // Hiển thị trang thanh toán
    public function checkout()
    {
        $cart = $this->cartService->getCartByUser(Auth::id());
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        return view('orders.checkout', compact('cart'));
    }

    // Xử lý thanh toán
    public function processCheckout(Request $request)
    {
        $cart = $this->cartService->getCartByUser(Auth::id());
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền
        $totalPrice = 0;
        $items = [];
        
        foreach ($cart->items as $item) {
            $totalPrice += $item->product->price * $item->quantity;
            $items[] = [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ];
        }

        DB::beginTransaction();
        try {
            // Tạo đơn hàng
            $order = $this->orderService->createOrder(Auth::id(), $items, $totalPrice);
            
            // Xóa giỏ hàng
            foreach ($cart->items as $item) {
                $this->cartService->removeItem($item->id);
            }
            
            DB::commit();

            // Gửi email xác nhận đặt hàng thành công
            try {
                Mail::to(Auth::user()->email)->send(new OrderSuccessMail($order));
            } catch (\Exception $mailEx) {
                Log::error('Không gửi được email xác nhận đơn hàng: ' . $mailEx->getMessage());
            }

            // Lưu thông báo vào notifications
            $noti = [
                'title' => 'Đặt hàng thành công',
                'message' => 'Bạn đã đặt đơn hàng #' . $order->id . ' thành công!',
                'time' => now()->format('d/m/Y H:i')
            ];
            $notifications = session('notifications', []);
            $notifications[] = $noti;
            session(['notifications' => $notifications]);

            return redirect()->route('orders.show', $order->id)->with('success', 'Đặt hàng thành công!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // Hiển thị chi tiết đơn hàng
    public function show($id)
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        $order = $orders->firstWhere('id', $id);
        
        if (!$order) {
            abort(404, 'Đơn hàng không tồn tại');
        }

        return view('orders.show', compact('order'));
    }
     // Hủy đơn hàng (chỉ khi trạng thái là pending)
    public function cancel($id)
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        $order = $orders->firstWhere('id', $id);
        if (!$order) {
            abort(404, 'Đơn hàng không tồn tại');
        }
        if ($order->status !== 'pending') {
            return back()->with('error', 'Chỉ có thể hủy đơn hàng khi đang chờ xử lý!');
        }
        $this->orderService->updateOrderStatus($order->id, 'cancelled');
        // Lưu thông báo vào notifications
        $noti = [
            'title' => 'Đơn hàng đã hủy',
            'message' => 'Bạn đã hủy đơn hàng #' . $order->id . '.',
            'time' => now()->format('d/m/Y H:i')
        ];
        $notifications = session('notifications', []);
        $notifications[] = $noti;
        session(['notifications' => $notifications]);
        return back()->with('success', 'Đã hủy đơn hàng thành công!');
    }

    // Đổi trả hàng
    public function returnOrder(Request $request, $id)
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        $order = $orders->firstWhere('id', $id);
        if (!$order) {
            abort(404, 'Đơn hàng không tồn tại');
        }
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:order_items,product_id',
            'reason' => 'required|string',
            'return_images.*' => 'nullable|image|max:4096',
        ]);
        $imagePaths = [];
        if ($request->hasFile('return_images')) {
            foreach ($request->file('return_images') as $file) {
                if ($file && $file->isValid()) {
                    $imagePaths[] = $file->store('returns', 'public');
                }
            }
        }
        $returnRequest = \App\Models\ReturnRequest::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'product_ids' => $request->product_ids,
            'reason' => $request->reason,
            'images' => $imagePaths,
            'status' => 'pending',
        ]);
        // Cập nhật trạng thái đơn hàng
        $this->orderService->updateOrderStatus($order->id, 'returning');
        // Lưu thông báo
        $noti = [
            'title' => 'Yêu cầu đổi trả',
            'message' => 'Bạn đã gửi yêu cầu đổi trả cho đơn hàng #' . $order->id . '.',
            'time' => now()->format('d/m/Y H:i')
        ];
        $notifications = session('notifications', []);
        $notifications[] = $noti;
        session(['notifications' => $notifications]);
        return back()->with('success', 'Đã gửi yêu cầu đổi trả!');
    }
}

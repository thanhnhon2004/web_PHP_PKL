<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReturnApprovedMail;
use App\Mail\ReturnRejectedMail;
use App\Models\ReturnRequest;
use App\Models\User;

class OrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // Duyệt yêu cầu đổi trả
    public function approveReturn($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $returnRequest = \App\Models\ReturnRequest::where('order_id', $order->id)->latest()->first();
        if (!$returnRequest || $returnRequest->status !== 'pending') {
            return back()->with('error', 'Không tìm thấy yêu cầu đổi trả đang chờ xử lý!');
        }
        $returnRequest->status = 'approved';
        $returnRequest->admin_reason = null;
        $returnRequest->save();
        // Cập nhật trạng thái đơn hàng
        $order->status = 'cancelled';
        $order->save();
        // Gửi email thông báo cho khách hàng
        $user = $order->user;
        try {
            Mail::to($user->email)->send(new ReturnApprovedMail($order, $returnRequest));
        } catch (\Exception $e) {
            // Có thể log lỗi nếu cần
        }
        return back()->with('success', 'Đã duyệt yêu cầu đổi trả!');
    }

    // Từ chối yêu cầu đổi trả
    public function rejectReturn(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $returnRequest = \App\Models\ReturnRequest::where('order_id', $order->id)->latest()->first();
        if (!$returnRequest || $returnRequest->status !== 'pending') {
            return back()->with('error', 'Không tìm thấy yêu cầu đổi trả đang chờ xử lý!');
        }
        $request->validate([
            'admin_reason' => 'required|string',
        ]);
        $returnRequest->status = 'rejected';
        $returnRequest->admin_reason = $request->admin_reason;
        $returnRequest->save();
        // Cập nhật trạng thái đơn hàng về completed (hoặc trạng thái khác nếu cần)
        $order->status = 'completed';
        $order->save();
        // Gửi email thông báo từ chối cho khách hàng
        $user = $order->user;
        try {
            Mail::to($user->email)->send(new ReturnRejectedMail($order, $returnRequest));
        } catch (\Exception $e) {
            // Có thể log lỗi nếu cần
        }
        return back()->with('success', 'Đã từ chối yêu cầu đổi trả!');
    }

    // Hiển thị danh sách tất cả đơn hàng
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product'])->latest();
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('from_date') && $request->from_date != '') {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        
        if ($request->has('to_date') && $request->to_date != '') {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $orders = $query->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        if ($order->status === 'cancelled') {
            return redirect()->route('admin.orders.show', $id)->with('error', 'Đơn hàng đã bị hủy, không thể cập nhật trạng thái!');
        }

        $this->orderService->updateOrderStatus($id, $request->status);
        return redirect()->route('admin.orders.show', $id)->with('success', 'Đã cập nhật trạng thái đơn hàng!');
    }
}

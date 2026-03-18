@php($user = $order->user)
<p>Xin chào {{ $user->name }},</p>
<p>Yêu cầu đổi trả cho đơn hàng <strong>#{{ $order->id }}</strong> của bạn đã bị <strong>từ chối</strong>.</p>
<p>Lý do từ chối: <strong>{{ $returnRequest->admin_reason }}</strong></p>
<p>Vui lòng tham khảo <a href="{{ url('/chinh-sach-doi-tra') }}">chính sách đổi trả</a> để biết thêm chi tiết.</p>
<p>Trân trọng,<br>Đội ngũ hỗ trợ khách hàng</p>

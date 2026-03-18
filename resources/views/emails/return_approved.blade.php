@php($user = $order->user)
<p>Xin chào {{ $user->name }},</p>
<p>Yêu cầu đổi trả cho đơn hàng <strong>#{{ $order->id }}</strong> của bạn đã được <strong>xác nhận</strong>.</p>
<p>Vui lòng đóng gói sản phẩm cần đổi trả và gửi qua bưu điện về địa chỉ: <br>
<strong>XYZ - 123 Đường ABC, Quận 1, TP.HCM</strong></p>
<p>Sau khi nhận được hàng, chúng tôi sẽ tiến hành xử lý đổi trả theo chính sách.</p>
<p>Trân trọng,<br>Đội ngũ hỗ trợ khách hàng</p>

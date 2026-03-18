@extends('emails.layout')
@section('content')
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fa;padding:30px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;overflow:hidden;">
                <tr>
                    <td style="padding:32px 32px 16px 32px;text-align:center;">
                        <h2 style="color:#198754;margin-bottom:12px;">Đặt hàng thành công!</h2>
                        <p style="color:#333;font-size:16px;margin-bottom:24px;">Cảm ơn bạn đã đặt hàng tại <strong>Camera Man</strong>.</p>
                        <p style="color:#555;font-size:15px;margin-bottom:24px;">Mã đơn hàng: <strong>#{{ $order->id }}</strong></p>
                        <p style="color:#555;font-size:15px;margin-bottom:24px;">Tổng tiền: <strong>{{ number_format($order->total_price, 0, ',', '.') }}đ</strong></p>
                        <p style="color:#555;font-size:15px;margin-bottom:24px;">Trạng thái: <strong>{{ $order->status }}</strong></p>
                        <hr style="margin:24px 0;">
                        <p style="color:#888;font-size:13px;">Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email hoặc hotline hỗ trợ.</p>
                        <p style="color:#888;font-size:13px;">Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi!</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection

@extends('layout.base')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(isset($success) && $success)
                <!-- Success State -->
                <div class="card border-success">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        
                        <h2 class="card-title text-success mb-3">Thanh toán thành công!</h2>
                        
                        @if(isset($order))
                            <div class="alert alert-info mb-4">
                                <p class="mb-2"><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                                <p class="mb-2"><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
                                <p class="mb-0"><strong>Trạng thái:</strong> <span class="badge bg-success">Đã thanh toán</span></p>
                            </div>

                            @if($order->transaction_no)
                                <p class="text-muted mb-3">
                                    <small>Mã giao dịch VNPay: {{ $order->transaction_no }}</small>
                                </p>
                            @endif
                        @endif

                        <p class="text-muted mb-4">
                            Cảm ơn bạn đã mua sắm. Đơn hàng của bạn đã được xác nhận thanh toán.
                        </p>

                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            @if(isset($order))
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-lg px-4 gap-3">
                                    <i class="fas fa-box"></i> Xem chi tiết đơn hàng
                                </a>
                            @endif
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="fas fa-shopping-bag"></i> Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <!-- Failure State -->
                <div class="card border-danger">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                        </div>
                        
                        <h2 class="card-title text-danger mb-3">Thanh toán thất bại!</h2>
                        
                        @if(isset($message))
                            <div class="alert alert-danger mb-4">
                                {{ $message }}
                            </div>
                        @endif

                        @if(isset($order))
                            <div class="alert alert-info mb-4">
                                <p class="mb-2"><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                                <p class="mb-2"><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
                                <p class="mb-0"><strong>Trạng thái:</strong> <span class="badge bg-warning">Chờ thanh toán</span></p>
                            </div>

                            <p class="text-muted mb-4">
                                Vui lòng thử lại hoặc liên hệ với chúng tôi để được hỗ trợ.
                            </p>

                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-warning btn-lg px-4 gap-3">
                                    <i class="fas fa-redo"></i> Thử thanh toán lại
                                </a>
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="fas fa-list"></i> Xem đơn hàng
                                </a>
                            </div>
                        @else
                            <p class="text-muted mb-4">
                                Không tìm thấy thông tin đơn hàng. Vui lòng liên hệ với chúng tôi.
                            </p>

                            <a href="{{ route('orders.index') }}" class="btn btn-primary btn-lg px-4">
                                <i class="fas fa-list"></i> Về danh sách đơn hàng
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Troubleshooting -->
                <div class="mt-4 p-4 bg-light rounded">
                    <h5 class="text-secondary mb-3">Các bước khắc phục sự cố:</h5>
                    <ol class="text-muted small">
                        <li>Kiểm tra lại thông tin thanh toán của bạn</li>
                        <li>Đảm bảo tài khoản ngân hàng có đủ số dư</li>
                        <li>Thử lại với một phương thức thanh toán khác</li>
                        <li>Nếu vẫn gặp lỗi, vui lòng liên hệ với bộ phận hỗ trợ</li>
                    </ol>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .card {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
</style>
@endsection

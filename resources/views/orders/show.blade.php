@extends('layout.main')
@section('noidung')
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Chi tiết đơn hàng</h1>
                <a href="{{ route('home') }}">Trang chủ</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="{{ route('orders.index') }}">Đơn hàng</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Chi tiết</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <style>
        :root {
            --primary: #E88F2A;
            --secondary: #FAF3EB;
            --light: #FFFFFF;
            --dark: #2B2825;
        }

        .order-detail-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: var(--light);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .badge-pending {
            background-color: #ffc107;
        }

        .badge-processing {
            background-color: #0dcaf0;
        }

        .badge-completed {
            background-color: #198754;
        }

        .badge-cancelled {
            background-color: #dc3545;
        }
    </style>

    <body>
        <div class="order-detail-container">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Order Header -->
            <div class="border-bottom pb-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3>Đơn hàng #{{ $order->id }}</h3>
                        <p class="text-muted mb-0">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <div class="mb-2">
                            <span class="badge badge-{{ $order->status }} fs-5">
                                @switch($order->status)
                                    @case('pending') Chờ xử lý @break
                                    @case('processing') Đang xử lý @break
                                    @case('completed') Hoàn thành @break
                                    @case('paid') Đã thanh toán @break
                                    @case('cancelled') Đã hủy @break
                                    @case('returning') Đang chờ xác nhận trả hàng @break
                                    @default {{ $order->status }}
                                @endswitch
                            </span>
                        </div>
                        @if(isset($order->payment_status))
                        <div>
                            @if($order->payment_status === 'completed')
                                <span class="badge bg-success fs-6">Thanh toán: Hoàn thành</span>
                            @elseif($order->payment_status === 'failed')
                                <span class="badge bg-danger fs-6">Thanh toán: Thất bại</span>
                            @else
                                <span class="badge bg-warning text-dark fs-6">Thanh toán: Chờ xử lý</span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="mb-4">
                <h5 class="mb-3">Thông tin khách hàng</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Tên:</strong> {{ $order->user->name }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Số điện thoại:</strong> {{ $order->user->phone ?? 'Chưa cập nhật' }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mb-4">
                <h5 class="mb-3">Sản phẩm đã đặt</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->product->name }}</strong><br>
                                    <small class="text-muted">{{ $item->product->brand->name ?? '' }}</small>
                                </td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $item->quantity }}</td>
                                <td><strong>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                <td><h5 class="text-primary mb-0">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</h5></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Đánh giá sản phẩm -->
            @if($order->status === 'completed')
                <div class="mb-4">
                    <h5 class="mb-3">Đánh giá sản phẩm</h5>
                    <div class="row">
                        @foreach($order->items as $item)
                            @php
                                $reviewed = $item->product->reviews()->where('user_id', $order->user_id)->where('order_id', $order->id)->exists();
                            @endphp
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <strong>{{ $item->product->name }}</strong>
                                        </div>
                                        @if(!$reviewed)
                                            <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#reviewModal-{{ $item->product->id }}">
                                                <i class="fas fa-star me-1"></i>Đánh giá
                                            </button>
                                        @else
                                            <span class="badge bg-success">Đã đánh giá</span>
                                        @endif
                                    </div>
                                </div>
                                @if(!$reviewed)
                                    @include('orders.partials.review_modal', ['product' => $item->product, 'order' => $order])
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="text-center">
                @if($order->isPending())
                    <a href="{{ route('payment.pay', $order->id) }}" class="btn btn-success btn-lg me-2">
                        <i class="fas fa-credit-card me-2"></i>Thanh toán ngay
                    </a>
                @endif
                
                @if($order->isPaymentFailed())
                    <div class="alert alert-danger mb-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>Thanh toán thất bại. Vui lòng thử lại.
                    </div>
                    <a href="{{ route('payment.pay', $order->id) }}" class="btn btn-warning btn-lg me-2">
                        <i class="fas fa-redo me-2"></i>Thử thanh toán lại
                    </a>
                @endif
                
                @if($order->isPaid())
                    <div class="alert alert-success mb-3">
                        <i class="fas fa-check-circle me-2"></i>Đơn hàng này đã được thanh toán thành công.
                    </div>
                @endif
                
                <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách đơn hàng
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </body>
@endsection

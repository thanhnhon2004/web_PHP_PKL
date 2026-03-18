@extends('layout.main')
@section('noidung')

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Đơn hàng của tôi</h1>
                <a href="{{ route('home') }}">Trang chủ</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Đơn hàng</a>
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

        .orders-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 15px;
        }

        .order-card {
            background-color: var(--light);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .order-header {
            border-bottom: 2px solid var(--primary);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
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

        .badge-returning {
            background-color: #f5c5c5;
        }
    </style>

    <body>
        <div class="orders-container">
            <h2 class="text-center mb-4">Đơn hàng của bạn</h2>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($orders && $orders->count() > 0)
                @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Đơn hàng #{{ $order->id }}</h5>
                            <small class="text-muted">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <div>
                            <span class="badge badge-{{ $order->status }} fs-6">
                                @switch($order->status)
                                    @case('pending') Chờ xử lý @break
                                    @case('processing') Đang xử lý @break
                                    @case('completed') Hoàn thành @break
                                    @case('cancelled') Đã hủy @break
                                    @case('returning') Đang chờ xác nhận trả hàng @break
                                    @default {{ $order->status }}
                                @endswitch
                            </span>
                        </div>
                    </div>

                    <div class="order-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="mb-3">Sản phẩm:</h6>
                                <ul class="list-unstyled">
                                    @foreach($order->items as $item)
                                    <li class="mb-2">
                                        <strong>{{ $item->product->name }}</strong> x {{ $item->quantity }} 
                                        <span class="text-muted">
                                            - {{ number_format($item->price, 0, ',', '.') }} VNĐ
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <h6>Tổng tiền:</h6>
                                <h4 class="text-primary">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</h4>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm mt-2">
                                    <i class="fas fa-eye me-1"></i>Xem chi tiết
                                </a>
                                @if($order->status === 'pending')
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline-block mt-2" onsubmit="return confirm('Bạn chắc chắn muốn hủy đơn hàng này?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times me-1"></i>Hủy đơn hàng
                                    </button>
                                </form>
                                @endif

                                                                @if($order->status === 'completed' && \Carbon\Carbon::parse($order->updated_at)->diffInDays(now()) <= 7)
                                                                <button type="button" class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#returnModal-{{ $order->id }}">
                                                                        <i class="fas fa-undo me-1"></i>Đổi trả
                                                                </button>
                                                                <!-- Modal Đổi trả -->
                                                                <div class="modal fade" id="returnModal-{{ $order->id }}" tabindex="-1" aria-labelledby="returnModalLabel-{{ $order->id }}" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="returnModalLabel-{{ $order->id }}">Yêu cầu đổi trả đơn hàng #{{ $order->id }}</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <form action="{{ route('orders.return', $order->id) }}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Họ tên khách hàng</label>
                                                                                        <input type="text" class="form-control" value="{{ $order->user->name }}" readonly>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Email</label>
                                                                                        <input type="email" class="form-control" value="{{ $order->user->email }}" readonly>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Sản phẩm muốn đổi trả</label>
                                                                                        <div class="row">
                                                                                            @foreach($order->items as $item)
                                                                                            <div class="col-12 mb-2">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="checkbox" name="product_ids[]" value="{{ $item->product->id }}" id="returnProduct-{{ $order->id }}-{{ $item->product->id }}">
                                                                                                    <label class="form-check-label" for="returnProduct-{{ $order->id }}-{{ $item->product->id }}">
                                                                                                        {{ $item->product->name }} x {{ $item->quantity }}
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Lý do đổi trả</label>
                                                                                        <textarea name="reason" class="form-control" rows="3" required placeholder="Nhập lý do đổi trả..."></textarea>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Ảnh minh họa (nếu có)</label>
                                                                                        <input type="file" name="return_images[]" class="form-control" accept="image/*" multiple required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                    <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="order-card text-center py-5">
                    <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted mb-4">Bạn chưa có đơn hàng nào</h4>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Mua sắm ngay
                    </a>
                </div>
            @endif
        </div>
    </body>
@endsection

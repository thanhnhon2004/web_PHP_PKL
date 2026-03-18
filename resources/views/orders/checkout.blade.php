@extends('layout.main')
@section('noidung')
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Thanh toán</h1>
                <a href="{{ route('home') }}">Trang chủ</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="{{ route('cart.index') }}">Giỏ hàng</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Thanh toán</a>
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

        .checkout-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 15px;
        }

        .checkout-card {
            background-color: var(--light);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background-color: #cf7d1f;
        }
    </style>

    <body>
        <div class="checkout-container">
            <div class="row g-4">
                <!-- Order Summary -->
                <div class="col-lg-7">
                    <div class="checkout-card">
                        <h4 class="mb-4">Thông tin giỏ hàng</h4>
                        
                        @php $total = 0; @endphp
                        @foreach($cart->items as $item)
                        @php 
                            $subtotal = $item->product->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <img src="{{ $item->product->image ? asset('img/products/' . $item->product->image) : 'https://via.placeholder.com/60' }}" 
                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;" 
                                     alt="{{ $item->product->name }}">
                                <div class="ms-3">
                                    <strong>{{ $item->product->name }}</strong><br>
                                    <small class="text-muted">Số lượng: {{ $item->quantity }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <strong>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</strong>
                            </div>
                        </div>
                        @endforeach

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <h5>Tổng cộng:</h5>
                            <h4 class="text-primary">{{ number_format($total, 0, ',', '.') }} VNĐ</h4>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="col-lg-5">
                    <div class="checkout-card">
                        <h4 class="mb-4">Thông tin thanh toán</h4>
                        
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form action="{{ route('orders.process') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="name" class="form-control" 
                                       value="{{ Auth::user()->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" 
                                       value="{{ Auth::user()->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" 
                                       value="{{ Auth::user()->phone }}" 
                                       placeholder="Nhập số điện thoại" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Địa chỉ giao hàng</label>
                                <textarea name="address" class="form-control" rows="3" 
                                          placeholder="Nhập địa chỉ giao hàng đầy đủ" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ghi chú (không bắt buộc)</label>
                                <textarea name="note" class="form-control" rows="2" 
                                          placeholder="Ghi chú cho đơn hàng"></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="fas fa-check-circle me-2"></i>Xác nhận đặt hàng
                                </button>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection

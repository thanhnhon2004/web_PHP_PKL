@extends('layout.main')
@section('noidung')
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Chi tiết sản phẩm</h1>
                <a href="{{ route('home') }}">Trang chủ</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('products.index') }}">Sản phẩm</a>
               <i class="fas fa-chevron-right"></i>
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

        .product-detail-card {
            background-color: var(--light);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 2rem;
            margin: 50px auto;
            max-width: 1000px;
        }

        .product-title {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-price {
            color: var(--primary);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-meta {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .product-description {
            color: var(--dark);
            font-size: 1rem;
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.8rem 1.5rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #cf7d1f;
        }

        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 8px;
            padding: 0.8rem 1.5rem;
            font-weight: 500;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: var(--light);
        }

        .quantity-input {
            width: 80px;
            text-align: center;
        }
    </style>

    <body>
        <div class="product-detail-card">
            <div class="row g-4">
                <!-- Product Image -->
                <div class="col-md-6 text-center">
                    <img src="{{ $product->image ? asset('img/products/' . $product->image) : 'https://via.placeholder.com/400x400' }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid rounded"
                         style="max-height: 500px; object-fit: cover;">
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <h2 class="product-title">{{ $product->name }}</h2>
                    <p class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                    
                    <div class="product-meta">
                        <p class="mb-2"><strong>Thương hiệu:</strong> {{ $product->brand->name ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Tình trạng:</strong> 
                            @if($product->stock > 0)
                                <span class="text-success">Còn {{ $product->stock }} sản phẩm</span>
                            @else
                                <span class="text-danger">Hết hàng</span>
                            @endif
                        </p>
                    </div>

                    <div class="product-description">
                        <h5>Mô tả sản phẩm:</h5>
                        <p>{{ $product->description ?? 'Chưa có mô tả chi tiết.' }}</p>
                    </div>

                    @if($product->stock > 0)
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <label for="quantity" class="mb-0">Số lượng:</label>
                                <input type="number" name="quantity" id="quantity" 
                                       class="form-control quantity-input" 
                                       value="1" min="1" max="{{ $product->stock }}">
                            </div>
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                                </button>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Tiếp tục mua sắm</a>
                            </div>
                        </form>
                        @else
                        <div class="alert alert-warning">
                            Vui lòng <a href="{{ route('login') }}" class="alert-link">đăng nhập</a> để mua hàng.
                        </div>
                        @endauth
                    @else
                        <div class="alert alert-danger">
                            Sản phẩm tạm hết hàng.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Đánh giá sản phẩm -->
            <div class="mt-5">
                <h4>Đánh giá sản phẩm</h4>
                @if($product->reviews->count())
                    @foreach($product->reviews as $review)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <strong>{{ $review->user->name }}</strong>
                                    <span class="ms-3 text-warning">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                        @endfor
                                    </span>
                                    <span class="ms-3 text-muted" style="font-size:0.9em;">{{ $review->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div>{{ $review->comment }}</div>
                                @if($review->images && count($review->images))
                                    <div class="mt-2">
                                        @foreach($review->images as $img)
                                            <a href="{{ asset('storage/' . $img) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $img) }}" style="width:60px;height:60px;object-fit:cover;margin:2px;" class="img-thumbnail">
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
                @endif
            </div>

            @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </body>
@endsection

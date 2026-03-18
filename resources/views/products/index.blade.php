@extends('layout.main')
@section('noidung')
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Sản phẩm</h1>
                <a href="{{ route('home') }}" class="text-white">Trang chủ</a>
                <i class="fas fa-chevron-right"></i>
                <span class="text-white">Sản phẩm</span>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product List Start -->
    <div class="container-fluid py-5">
        <div class="container">
            
            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="card border-0 rounded-2 shadow-sm position-sticky" style="top: 84px; z-index: 10;">
                        <div class="card-body p-4 ">
                            <div class="d-flex justify-content-between align-items-center  p-3">
                                <div class="d-flex align-items-center gap-2"><i class="fas fa-sliders-h"></i>
                                    <h4>Bộ lọc</h4>
                                </div>
                                <a href="{{ route('products.index') }}" class="filter-reset-link text-black">
                                    ĐẶT LẠI
                                </a>
                            </div>
                            <form id="filterForm" action="{{ route('products.index') }}" method="GET">
                                <!-- Search Bar -->
                                <div class="mb-4">
                                    <div class="input-group input-group-lg position-relative">
                                        <input type="text" id="searchInput" name="search" class="form-control rounded-2"
                                            placeholder="Tìm kiếm ..." value="{{ request('search') }}">
                                        <span class="search-icon-inside">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="4" y="6" width="16" height="2.5" rx="1.25"
                                                    fill="#9bceb7" />
                                                <rect x="7" y="11" width="10" height="2.5" rx="1.25"
                                                    fill="#9bceb7" />
                                                <rect x="10" y="16" width="4" height="2.5" rx="1.25"
                                                    fill="#9bceb7" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-folder-open text-primary me-2"></i>Danh mục
                                    </label>
                                    <div class="category-checkbox-group">
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="radio" name="category_id" value="" id="cat_all" {{ empty(request('category_id')) ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="cat_all">Tất cả danh mục</label>
                                        </div>
                                        @foreach($categories as $category)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="radio" name="category_id" value="{{ $category->id }}" id="cat_{{ $category->id }}" {{ request('category_id') == $category->id ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="cat_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-copyright text-primary me-2"></i>Thương hiệu
                                    </label>
                                    <select name="brand_id" class="form-select" onchange="this.form.submit()">
                                        <option value="">Tất cả thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-dollar-sign text-primary me-2"></i>Khoảng giá
                                    </label>
                                    <select name="max_price" class="form-select" onchange="this.form.submit()">
                                        <option value="">Tất cả mức giá</option>
                                        <option value="5000000" {{ request('max_price') == '5000000' ? 'selected' : '' }}>
                                            Dưới 5 triệu
                                        </option>
                                        <option value="10000000"
                                            {{ request('max_price') == '10000000' ? 'selected' : '' }}>
                                            Dưới 10 triệu
                                        </option>
                                        <option value="20000000"
                                            {{ request('max_price') == '20000000' ? 'selected' : '' }}>
                                            Dưới 20 triệu
                                        </option>
                                        <option value="30000000"
                                            {{ request('max_price') == '30000000' ? 'selected' : '' }}>
                                            Dưới 30 triệu
                                        </option>
                                        <option value="50000000"
                                            {{ request('max_price') == '50000000' ? 'selected' : '' }}>
                                            Dưới 50 triệu
                                        </option>
                                        <option value="100000000"
                                            {{ request('max_price') == '100000000' ? 'selected' : '' }}>
                                            Dưới 100 triệu
                                        </option>
                                    </select>
                                </div>
                                @if (request()->hasAny(['search', 'category_id', 'brand_id', 'max_price', 'sort']))
                                    
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Products Grid -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-end align-items-center mb-3">

                    </div>
                    <!-- Product Count -->
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-between align-items-center ">
                            <p class="text-muted">
                                <i class="fas fa-box me-2"></i>
                                Hiển thị <strong>{{ $products->count() }}</strong> trong tổng số
                                <strong>{{ $products->total() }}</strong> sản phẩm
                            </p>
                            <form id="sortForm" action="{{ route('products.index') }}" method="GET"
                                class="d-flex align-items-center">
                                <label for="sort" class="form-label fw-bold mb-0 me-2">
                                    <i class="fas fa-sort text-primary me-1"></i>Sắp xếp:
                                </label>
                                <select name="sort" id="sort" class="form-select form-select-sm w-auto"
                                    onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất
                                    </option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá:
                                        Thấp → Cao</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                        Giá: Cao → Thấp</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên: A
                                        → Z</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Tên:
                                        Z → A</option>
                                </select>
                                <!-- Giữ lại các filter khác khi sort -->
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                @php
                                    $catIds = request('category_id');
                                    if (is_array($catIds)) {
                                        $catIdsStr = implode(',', array_filter($catIds));
                                    } else {
                                        $catIdsStr = $catIds;
                                    }
                                @endphp
                                <input type="hidden" name="category_id" value="{{ $catIdsStr }}">
                                <input type="hidden" name="brand_id" value="{{ request('brand_id') }}">
                                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                            </form>
                        </div>
                    </div>
                    <div class="row g-5">
                        @forelse($products as $product)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class=" rounded-2 product-card shadow-sm rounded-4 p-3 h-100 d-flex flex-column justify-content-between" style="background: #fff;">
                                    <div class="position-relative mb-3 ">
                                        <img class="img-fluid w-100 rounded-2" style="aspect-ratio: 1/1; object-fit: cover; background: #f5f5f5;" src="{{ $product->image ? asset('img/products/' . $product->image) : asset('img/team-1.jpg') }}" alt="{{ $product->name }}">
                                        <!-- Icon trái tim góc trên phải -->
                                        <button type="button" class="btn btn-outline-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" style="z-index:2;">
                                            <i class="far fa-heart text-danger "></i>
                                        </button>
                                        <!-- Icon con mắt góc dưới giữa -->
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-white bg-white btn-sm position-absolute bottom-0 start-0 m-2 rounded-circle shadow" style="z-index:2; border: 2px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                                <i class="far fa-eye text-black" style=" font-size: 0.8rem; "></i>
                                            </a>
                                    </div>
                                    <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                        <div class="mb-2">
                                            <div class="text-uppercase text-muted small mb-1" style="letter-spacing:1px;">{{ $product->category->name ?? '' }}</div>
                                            <div class="fw-bold mb-1" style="font-size:1.1rem; color:#222;">{{ $product->name }}</div>
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="fw-bold" style="color:#00B686; font-size:1.2rem;">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                                @if($product->old_price && $product->old_price > $product->price)
                                                    <span class="text-decoration-line-through text-muted" style="font-size:1rem;">{{ number_format($product->old_price, 0, ',', '.') }}đ</span>
                                                @endif
                                            </div>
                                        </div>
                                        @auth
                                            <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-outline-success w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                                                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-outline-success w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 mt-auto">
                                                <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">Không có sản phẩm nào.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="row mt-5">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $products->links('pagination::bootstrap-5', ['class' => 'pagination-rounded']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product List End -->

       

        <!-- JavaScript for Filters -->
        <script>
            // Auto-search khi gõ (debounce 500ms)
            let searchTimeout;
            const searchInput = document.getElementById('searchInput');

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.form.submit();
                    }, 500); // Chờ 0.5 giây sau khi user ngừng gõ
                });

                // Submit ngay khi nhấn Enter
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        this.form.submit();
                    }
                });
            }
        </script>
    @endsection

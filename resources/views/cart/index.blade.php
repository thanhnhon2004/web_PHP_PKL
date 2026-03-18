@extends('layout.main')
@section('noidung')
    <!-- Page Header Start --> 
<!-- Bootstrap 5.3.2 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome 6.5.0 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Import style.css sau bootstrap để ghi đè màu bg-primary -->
<link rel="stylesheet" href="/css/style.css">
<style>
body { background: #ffffff; font-family: 'Segoe UI', sans-serif; }
.cart-main { max-width: 1200px; margin: 40px auto; }
.cart-title { font-size: 2rem; font-weight: 700; color: #1f6f5d; margin-bottom: 8px; }
.cart-desc { color: #7a8a8a; font-size: 1.1rem; margin-bottom: 32px; }
.cart-list { background: #fff; border-radius: 24px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 32px 24px; }
.cart-item { display: flex; align-items: center; gap: 24px; border-radius: 18px; background: #fafaf8; margin-bottom: 24px; padding: 24px 18px; box-shadow: 0 2px 8px rgba(44,62,80,0.04); }
.cart-item:last-child { margin-bottom: 0; }
.cart-item-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; background: #f5f5f5; }
.cart-item-info { flex: 1; }
.cart-item-name { font-weight: 700; font-size: 1.1rem; color: #222; }
.cart-item-desc { color: #7a8a8a; font-size: 0.95rem; margin-bottom: 6px; }
.cart-item-price { color: #e88f2a; font-weight: 700; font-size: 1.15rem; }
.cart-item-oldprice { color: #b0b0b0; text-decoration: line-through; font-size: 0.95rem; margin-left: 8px; }
.cart-item-qty { display: flex; align-items: center; gap: 8px; }
.cart-qty-btn { width: 32px; height: 32px; border-radius: 999px; border: none; background: #f6f8f7; color: #1f6f5d; font-size: 1.1rem; font-weight: 700; transition: background 0.2s; }
.cart-qty-btn:hover { background: #2fd6a7; color: #fff; }
.cart-qty-input { width: 40px; text-align: center; border: none; background: transparent; font-weight: 700; font-size: 1rem; }
.cart-item-remove { color: #e88f2a; background: none; border: none; font-size: 1.2rem; margin-left: 12px; transition: color 0.2s; }
.cart-item-remove:hover { color: #d13c2f; }
.cart-summary { background: #fff; border-radius: 24px; box-shadow: 0 4px 24px rgba(44,62,80,0.08); padding: 32px 24px; min-width: 340px; }
.cart-summary-title { font-size: 1.3rem; font-weight: 700; color: #1f6f5d; margin-bottom: 18px; }
.cart-summary-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.cart-summary-label { color: #7a8a8a; font-size: 1rem; }
.cart-summary-value { font-weight: 600; color: #222; font-size: 1rem; }
.cart-summary-value.free { color: #2fd6a7; }
.cart-summary-total { font-size: 1.5rem; font-weight: 700; color: #e88f2a; margin-bottom: 18px; }
.cart-summary-coupon { display: flex; gap: 8px; margin-bottom: 18px; }
.cart-summary-coupon input { flex: 1; border-radius: 12px; border: 1.5px solid #e0e0e0; font-size: 1rem; padding: 0.7rem 1rem; background: #f8f8f8; }
.cart-summary-coupon button { border-radius: 999px; background: #1f6f5d; color: #fff; font-weight: 700; border: none; padding: 0.7rem 24px; font-size: 1rem; transition: background 0.2s; }
.cart-summary-coupon button:hover { background: #174c3d; }
.cart-summary-pay { width: 100%; border-radius: 999px; background: #e88f2a; color: #fff; font-weight: 700; font-size: 1.15rem; padding: 0.9rem 0; border: none; margin-bottom: 12px; transition: background 0.2s; }
.cart-summary-pay:hover { background: #d13c2f; }
.cart-summary-note { color: #7a8a8a; font-size: 0.95rem; text-align: center; margin-top: 12px; }
.cart-summary-icons { display: flex; gap: 16px; justify-content: center; margin-top: 8px; color: #b0b0b0; font-size: 1.2rem; }
.cart-empty { text-align: center; padding: 60px 0; color: #b0b0b0; }
.cart-empty i { font-size: 4rem; margin-bottom: 18px; }
.cart-empty h4 { margin-bottom: 18px; }
</style>

<div class="cart-main">
    <div class="cart-title">Giỏ hàng của bạn</div>
    <div class="cart-desc">Hoàn tất lựa chọn cho những khoảnh khắc đáng giá.</div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="cart-list">
                @if($cart && $cart->items->count() > 0)
                    @foreach($cart->items as $item)
                        <div class="cart-item" data-item-row="{{ $item->id }}">
                            <img src="{{ $item->product->image ? asset('img/products/' . $item->product->image) : 'https://via.placeholder.com/80' }}" class="cart-item-img" alt="{{ $item->product->name }}">
                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $item->product->name }}</div>
                                <div class="cart-item-desc">{{ $item->product->brand->name ?? '' }}</div>
                                <div class="cart-item-qty mt-2">
                                    <button type="button" class="cart-qty-btn btn-decrease" data-item-id="{{ $item->id }}" data-min="1"><i class="fa fa-minus"></i></button>
                                    <input type="text" class="cart-qty-input quantity-input" data-item-id="{{ $item->id }}" data-price="{{ $item->product->price }}" data-max="{{ $item->product->stock }}" value="{{ $item->quantity }}" readonly>
                                    <button type="button" class="cart-qty-btn btn-increase" data-item-id="{{ $item->id }}" data-max="{{ $item->product->stock }}"><i class="fa fa-plus"></i></button>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cart-item-remove" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="cart-item-price">{{ number_format($item->product->price, 0, ',', '.') }} đ</div>
                        </div>
                    @endforeach
                @else
                    <div class="cart-empty">
                        <i class="fa fa-shopping-cart"></i>
                        <h4>Giỏ hàng của bạn đang trống</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-success rounded-pill px-4"><i class="fa fa-shopping-bag me-2"></i>Mua sắm ngay</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="cart-summary">
                <div class="cart-summary-title">Tóm tắt đơn hàng</div>
                <div class="cart-summary-row">
                    <div class="cart-summary-label">Tạm tính</div>
                    <div class="cart-summary-value">{{ number_format($cart ? $cart->items->sum(function($i){return $i->product->price * $i->quantity;}) : 0, 0, ',', '.') }} đ</div>
                </div>
                <div class="cart-summary-row">
                    <div class="cart-summary-label">Phí vận chuyển</div>
                    <div class="cart-summary-value free">MIỄN PHÍ</div>
                </div>
                <div class="cart-summary-row">
                    <div class="cart-summary-label">Mã giảm giá</div>
                    <div class="cart-summary-value">- 0 đ</div>
                </div>
                <div class="cart-summary-total">Tổng cộng <span class="cart-total">{{ number_format($cart ? $cart->items->sum(function($i){return $i->product->price * $i->quantity;}) : 0, 0, ',', '.') }} đ</span></div>
                <div class="cart-summary-coupon">
                    <input type="text" placeholder="NHẬP MÃ ƯU ĐÃI">
                    <button type="button">Áp dụng</button>
                </div>
                <form action="{{ route('orders.checkout') }}" method="GET">
                    <button type="submit" class="cart-summary-pay">Thanh toán</button>
                </form>
                <div class="cart-summary-icons">
                    <i class="fa fa-shield-halved"></i>
                    <i class="fa fa-truck"></i>
                    <i class="fa fa-credit-card"></i>
                </div>
                <div class="cart-summary-note">Giao hàng miễn phí toàn quốc • Bảo mật 256-bit</div>
            </div>
        </div>
    </div>
</div>
        <!-- JavaScript for Cart Updates -->
        <script>
            // Format số tiền
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN').format(amount) + ' VNĐ';
            }

            // Cập nhật tổng tiền
            function updateCartTotal() {
                let total = 0;
                document.querySelectorAll('.quantity-input').forEach(input => {
                    const quantity = parseInt(input.value);
                    const price = parseFloat(input.dataset.price);
                    total += quantity * price;
                });
                document.querySelector('.cart-total').textContent = formatCurrency(total);
            }

            // Cập nhật subtotal của item
            function updateItemSubtotal(itemId, quantity, price) {
                const subtotal = quantity * price;
                const subtotalElement = document.querySelector(`.item-subtotal[data-item-id="${itemId}"]`);
                if (subtotalElement) {
                    subtotalElement.textContent = formatCurrency(subtotal);
                }
            }

            // Cập nhật quantity lên server (AJAX với debounce)
            let updateTimeouts = {};
            function updateQuantityOnServer(itemId, quantity) {
                clearTimeout(updateTimeouts[itemId]);
                updateTimeouts[itemId] = setTimeout(() => {
                    fetch(`/cart/${itemId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ quantity: quantity })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi cập nhật:', error);
                    });
                }, 500); // Đợi 0.5s sau lần thay đổi cuối
            }

            // Xử lý nút giảm (-)
            document.querySelectorAll('.btn-decrease').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.dataset.itemId;
                    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                    let quantity = parseInt(input.value);
                    const min = parseInt(this.dataset.min);
                    
                    if (quantity > min) {
                        quantity--;
                        input.value = quantity;
                        
                        const price = parseFloat(input.dataset.price);
                        updateItemSubtotal(itemId, quantity, price);
                        updateCartTotal();
                        updateQuantityOnServer(itemId, quantity);
                    }
                });
            });

            // Xử lý nút tăng (+)
            document.querySelectorAll('.btn-increase').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.dataset.itemId;
                    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
                    let quantity = parseInt(input.value);
                    const max = parseInt(this.dataset.max);
                    
                    if (quantity < max) {
                        quantity++;
                        input.value = quantity;
                        
                        const price = parseFloat(input.dataset.price);
                        updateItemSubtotal(itemId, quantity, price);
                        updateCartTotal();
                        updateQuantityOnServer(itemId, quantity);
                    } else {
                        alert(`Chỉ còn ${max} sản phẩm trong kho!`);
                    }
                });
            });
        </script>
    </body>
@endsection

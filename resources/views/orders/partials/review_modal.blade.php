<div class="modal fade" id="reviewModal-@php echo $product->id; @endphp" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('orders.products.review', ['order' => $order->id, 'product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="reviewModalLabel">Đánh giá sản phẩm: {{ $product->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Chọn số sao:</label>
            <div class="star-rating">
              @for($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}-{{ $product->id }}" name="rating" value="{{ $i }}" required />
                <label for="star{{ $i }}-{{ $product->id }}" title="{{ $i }} sao">&#9733;</label>
              @endfor
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Nhận xét:</label>
            <textarea name="comment" class="form-control" rows="3" placeholder="Viết nhận xét..."></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Ảnh minh họa (tùy chọn):</label>
            <input type="file" name="review_images[]" class="form-control" multiple accept="image/*">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
.star-rating {
  direction: rtl;
  display: inline-flex;
}
.star-rating input[type="radio"] {
  display: none;
}
.star-rating label {
  font-size: 2rem;
  color: #ddd;
  cursor: pointer;
}
.star-rating input[type="radio"]:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
  color: #ffc107;
}
</style>

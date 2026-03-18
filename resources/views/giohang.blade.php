@extends('layout.main')
@section('noidung')
  
  <style>
    :root {
      --primary: #E88F2A;
      --secondary: #FAF3EB;
      --light: #FFFFFF;
      --dark: #2B2825;
    }

    body {
      background-color: var(--secondary);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .cart-container {
      max-width: 1000px;
      margin: 50px auto;
      background-color: var(--light);
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 2rem;
    }

    .cart-title {
      color: var(--dark);
      font-weight: 700;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .product-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
    }

    .btn-primary {
      background-color: var(--primary);
      border: none;
    }

    .btn-primary:hover {
      background-color: #cf7d1f;
    }

    .btn-outline-primary {
      border: 2px solid var(--primary);
      color: var(--primary);
    }

    .btn-outline-primary:hover {
      background-color: var(--primary);
      color: var(--light);
    }
  </style>
<body>
  <div class="cart-container">
    <h2 class="cart-title">Giỏ hàng của bạn</h2>

    <!-- Danh sách sản phẩm -->
    <table class="table align-middle">
      <thead>
        <tr>
          <th>Ảnh</th>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Giá</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="https://via.placeholder.com/60" class="product-img" alt="Sản phẩm"></td>
          <td>Bánh kem socola</td>
          <td>
            <div class="d-flex align-items-center">
              <button class="btn btn-sm btn-outline-primary me-2">-</button>
              <input type="text" class="form-control form-control-sm text-center" value="1" style="width:50px;">
              <button class="btn btn-sm btn-outline-primary ms-2">+</button>
            </div>
          </td>
          <td>250.000 VNĐ</td>
          <td><button class="btn btn-sm btn-danger">Xóa</button></td>
        </tr>
        <tr>
          <td><img src="https://via.placeholder.com/60" class="product-img" alt="Sản phẩm"></td>
          <td>Bánh kem dâu</td>
          <td>
            <div class="d-flex align-items-center">
              <button class="btn btn-sm btn-outline-primary me-2">-</button>
              <input type="text" class="form-control form-control-sm text-center" value="2" style="width:50px;">
              <button class="btn btn-sm btn-outline-primary ms-2">+</button>
            </div>
          </td>
          <td>300.000 VNĐ</td>
          <td><button class="btn btn-sm btn-danger">Xóa</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Phần thanh toán -->
    <div class="d-flex justify-content-between align-items-center mt-4">
      <h5 class="text-dark">Tổng tiền: <span class="text-primary">550.000 VNĐ</span></h5>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Thanh toán</button>
    </div>
  </div>

  <!-- Modal form thanh toán -->
  <div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Thông tin thanh toán</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label class="form-label">Họ và tên</label>
              <input type="text" class="form-control" placeholder="Nhập họ và tên">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Nhập email">
            </div>
            <div class="mb-3">
              <label class="form-label">Địa chỉ giao hàng</label>
              <input type="text" class="form-control" placeholder="Nhập địa chỉ">
            </div>
            <div class="mb-3">
              <label class="form-label">Số điện thoại</label>
              <input type="text" class="form-control" placeholder="Nhập số điện thoại">
            </div>
            <button type="submit" class="btn btn-primary w-100">Xác nhận thanh toán</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
</body>
@endsection
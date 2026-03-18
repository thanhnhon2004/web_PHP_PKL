@extends('layout.main')
@section('noidung')
  

    <style>
        :root { 
             --primary: #9bceb7;
    --secondary: #ffffff;
    --light: #FFFFFF;
    --dark: #2B2825;
        }

        .profile-main-container {
            max-width: 1200px;
            margin: 0 auto 4rem;
            display: flex;
            gap: 2rem;
        }
        .profile-sidebar {
            width: 320px;
            background: var(--light);
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 500px;
        }
        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            font-size: 2.7rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.2rem;
            position: relative;
        }
        .profile-avatar-edit {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #fff;
            border-radius: 50%;
            border: 2px solid var(--primary);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            cursor: pointer;
            font-size: 1.2rem;
        }
        .profile-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
            text-align: center;
        }
        .profile-rank {
            font-size: 0.95rem;
            color: #4caf50;
            background: #e8f5e9;
            border-radius: 12px;
            padding: 0.2rem 0.8rem;
            margin-bottom: 1.2rem;
            display: inline-block;
        }
        .profile-menu {
            width: 100%;
            margin-top: 1.2rem;
        }
        .profile-menu-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.9rem 1rem;
            border-radius: 8px;
            color: var(--dark);
            font-weight: 500;
            font-size: 1.08rem;
            margin-bottom: 0.2rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .profile-menu-item.active, .profile-menu-item:hover {
            background: var(--secondary);
            color: var(--primary);
        }
        .profile-content {
            flex: 1;
            background: var(--light);
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            min-height: 500px;
        }
        @media (max-width: 900px) {
            .profile-main-container { flex-direction: column; }
            .profile-sidebar, .profile-content { width: 100%; min-width: 0; }
        }
        /* Fix Bootstrap pagination color & spacing for profile page */
    .pagination .page-link {
        color: var(--primary) !important;
        border-radius: 999px !important;
        border: 1px solid #e0e0e0;
        font-weight: 600;
        margin: 0 6px !important;
    }
    .pagination .page-item.active .page-link {
        background: var(--primary) !important;
        color: #fff !important;
        border-color: var(--primary) !important;
    }
    .pagination .page-link:focus {
        box-shadow: none !important;
    }
    .pagination .page-link:hover {
        background: #f6f6f6;
        color: var(--primary);
    }
    .pagination .page-item.disabled .page-link {
        color: #b0b0b0 !important;
        background: #fff !important;
    }
    </style>
  <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Tài khoản của tôi</h1>
                <a href="{{ route('home') }}" class="text-white">Trang chủ</a>
                <i class="far fa-square text-primary px-2"></i>
                <span class="text-white">Tài khoản</span>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
        <div class="container profile-main-container">
                <!-- Sidebar: Thông tin cá nhân và các nút -->
                <div class="profile-sidebar align-items-start">
                        <div class="profile-avatar mb-3 mx-auto">
                                {{ strtoupper(substr($user->name,0,1)) }}{{ strtoupper(substr(explode(' ', $user->name)[count(explode(' ', $user->name))-1],0,1)) }}
                                <span class="profile-avatar-edit" title="Đổi avatar"><i class="fas fa-camera"></i></span>
                        </div>
                        <div class="profile-name text-center w-100">{{ $user->name }}</div>
                        <div class="w-100 mt-4">
                                <div class="mb-3"><i class="fas fa-phone-alt me-2"></i> {{ $user->phone }}</div>
                                <div class="mb-3"><i class="fas fa-envelope me-2"></i> {{ $user->email }}</div>
                                <div class="mb-3"><i class="fas fa-map-marker-alt me-2"></i> 
                                        @if($addresses && count($addresses) > 0)
                                                {{ $addresses[0]->address }}
                                        @else
                                                <span class="text-muted">Chưa có địa chỉ</span>
                                        @endif
                                </div>
                                <button class="btn btn-outline-primary w-100 mb-2" onclick="openEditInfoModal()"><i class="fas fa-user-edit me-2"></i>Đổi thông tin tài khoản</button>
                                <button class="btn btn-outline-warning w-100 mb-2" onclick="openEditPasswordModal()"><i class="fas fa-key me-2"></i>Đổi mật khẩu</button>
                                <button class="btn btn-outline-secondary w-100 mb-2" onclick="openEditAddressModal()"><i class="fas fa-map-marker-alt me-2"></i>Đổi địa chỉ</button>
                        </div>
                </div>
                <!-- Main Content: Danh sách đơn hàng -->
                <div class="profile-content">
                        <h3 class="mb-4" style="color:var(--primary);font-weight:700;">Đơn hàng của bạn</h3>
                        @if($orders && $orders->count() > 0)
                                @foreach($orders as $order)
                                <div class="order-card mb-4">
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
                                                                        <button type="submit" class="btn btn-danger btn-sm">Hủy đơn</button>
                                                                </form>
                                                                @endif
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                @endforeach
                                <div class="d-flex justify-content-center mt-4">
                                        {{ $orders->links() }}
                                </div>
                        @else
                                <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
                        @endif
                </div>
        </div>

        <!-- Modal: Đổi thông tin tài khoản -->
        <div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('profile.updateInfo') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editInfoModalLabel">Đổi thông tin tài khoản</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Họ và tên</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            </div>
                            <input type="hidden" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal: Đổi mật khẩu -->
        <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('profile.updatePassword') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPasswordModalLabel">Đổi mật khẩu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mật khẩu hiện tại <span class="text-danger">*</span></label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mật khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                                <small class="text-muted">Tối thiểu 8 ký tự</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal: Đổi địa chỉ -->
        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('profile.addAddress') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAddressModalLabel">Địa chỉ của tôi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @forelse($addresses as $address)
                            <div class="d-flex align-items-center mb-2">
                                <form action="{{ route('profile.deleteAddress', $address->id) }}" method="POST" class="me-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa địa chỉ này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('profile.updateAddress', $address->id) }}" method="POST" class="flex-grow-1 d-flex">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="address" class="form-control me-2" value="{{ $address->address }}" required>
                                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                                </form>
                            </div>
                            @empty
                            <div class="text-center text-muted py-3 border rounded">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p class="mb-0">Chưa có địa chỉ nào được lưu</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function openEditInfoModal() {
                var modal = new bootstrap.Modal(document.getElementById('editInfoModal'));
                modal.show();
            }
            function openEditPasswordModal() {
                var modal = new bootstrap.Modal(document.getElementById('editPasswordModal'));
                modal.show();
            }
            function openEditAddressModal() {
                var modal = new bootstrap.Modal(document.getElementById('editAddressModal'));
                modal.show();
            }
        </script>

    <!-- JavaScript for Toggle Edit Mode -->
    <script>
        function toggleEditMode() {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');
            const editBtn = document.getElementById('editProfileBtn');
            
            if (viewMode.style.display === 'none') {
                // Đang ở edit mode, chuyển về view mode
                viewMode.style.display = 'block';
                editMode.style.display = 'none';
                editBtn.innerHTML = '<i class="fas fa-edit me-2"></i>Chỉnh sửa hồ sơ';
                editBtn.classList.remove('btn-secondary');
                editBtn.classList.add('btn-light');
            } else {
                // Đang ở view mode, chuyển sang edit mode
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
                editBtn.innerHTML = '<i class="fas fa-eye me-2"></i>Xem hồ sơ';
                editBtn.classList.remove('btn-light');
                editBtn.classList.add('btn-secondary');
            }
        }
    </script>

    <!-- Tab switching logic for sidebar menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.profile-menu-item');
            const tabIds = ['info', 'orders', 'address', 'password'];
            menuItems.forEach((item, idx) => {
                item.addEventListener('click', function() {
                    menuItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                    // Hide all tab panes
                    tabIds.forEach(id => {
                        const tab = document.getElementById(id);
                        if(tab) tab.classList.remove('show', 'active');
                    });
                    // Show the selected tab
                    if(tabIds[idx]) {
                        const tab = document.getElementById(tabIds[idx]);
                        if(tab) tab.classList.add('show', 'active');
                    }
                });
            });
        });
    </script>

    <!-- Tabs Content (moved into .profile-content) -->
   
    <script>
        function toggleEditAddressMode() {
            const view = document.getElementById('viewAddressMode');
            const edit = document.getElementById('editAddressMode');
            if(view.style.display === 'none') {
                view.style.display = 'block';
                edit.style.display = 'none';
            } else {
                view.style.display = 'none';
                edit.style.display = 'block';
            }
        }
    </script>

    
@endsection

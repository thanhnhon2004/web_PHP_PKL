@extends('admin.layout')

@section('page-title', 'Quản lý Đơn hàng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Danh sách Đơn hàng</h4>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Từ ngày</label>
                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Đến ngày</label>
                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter me-2"></i>Lọc
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo me-2"></i>Đặt lại
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="80">Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th width="150" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ $order->user->phone ?? 'N/A' }}</td>
                        <td><strong class="text-primary">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</strong></td>
                        <td>
                            <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 
                                ($order->status == 'pending' ? 'warning' : 
                                ($order->status == 'processing' ? 'info' : 'danger')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">Chưa có đơn hàng nào</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ $orders->links('pagination::bootstrap-5') }}
@endsection

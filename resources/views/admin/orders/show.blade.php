@extends('admin.layout')

@section('page-title', 'Chi tiết Đơn hàng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="fas fa-file-invoice me-2"></i>Đơn hàng #{{ $order->id }}</h4>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Quay lại
    </a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-shopping-bag me-2"></i>Danh sách sản phẩm
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->product->image)
                                        <img src="{{ asset('img/products/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="img-thumbnail me-2" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <strong>{{ $item->product->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                <td class="text-end"><strong>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                <td class="text-end">
                                    <h5 class="mb-0 text-primary">
                                        {{ number_format($order->total_price, 0, ',', '.') }} VNĐ
                                    </h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @if($order->status === 'returning')
            @php
                $returnRequest = \App\Models\ReturnRequest::where('order_id', $order->id)->latest()->first();
            @endphp
            @if($returnRequest)
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <i class="fas fa-undo me-2"></i>Phiếu yêu cầu đổi trả
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Khách hàng:</strong> {{ $returnRequest->user->name }}<br>
                            <strong>Email:</strong> {{ $returnRequest->user->email }}<br>
                            <strong>Thời gian gửi:</strong> {{ $returnRequest->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Lý do đổi trả:</strong><br>
                            <span>{{ $returnRequest->reason }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Sản phẩm yêu cầu đổi trả:</strong>
                        <ul>
                            @foreach($order->items as $item)
                                @if(in_array($item->product_id, $returnRequest->product_ids))
                                <li class="mb-2 d-flex align-items-center">
                                    @if($item->product->image)
                                    <img src="{{ asset('img/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail me-2" style="width:40px;height:40px;object-fit:cover;">
                                    @endif
                                    <span>{{ $item->product->name }} x {{ $item->quantity }} - {{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @if($returnRequest->images && count($returnRequest->images))
                    <div class="mb-3">
                        <strong>Ảnh minh họa:</strong><br>
                        @foreach($returnRequest->images as $img)
                            <a href="{{ asset('storage/' . $img) }}" target="_blank">
                                <img src="{{ asset('storage/' . $img) }}" style="width:80px;height:80px;object-fit:cover;margin:4px;" class="img-thumbnail">
                            </a>
                        @endforeach
                    </div>
                    @endif
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.orders.return.approve', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i> Xác nhận đổi trả</button>
                        </form>
                        <form action="{{ route('admin.orders.return.reject', $order->id) }}" method="POST">
                            @csrf
                            <input type="text" name="admin_reason" class="form-control d-inline-block w-auto me-2" placeholder="Lý do từ chối" required style="max-width:200px;display:inline-block;">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-times me-1"></i> Từ chối</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Mã đơn:</strong> #{{ $order->id }}
                    </li>
                    <li class="mb-2">
                        <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
                    </li>
                    <li class="mb-2">
                        <strong>Trạng thái:</strong>
                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 
                            ($order->status == 'pending' ? 'warning' : 
                            ($order->status == 'processing' ? 'info' : 'danger')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-2"></i>Thông tin khách hàng
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Họ tên:</strong> {{ $order->user->name }}
                    </li>
                    <li class="mb-2">
                        <strong>Email:</strong> {{ $order->user->email }}
                    </li>
                    <li class="mb-2">
                        <strong>Điện thoại:</strong> {{ $order->user->phone ?? 'N/A' }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit me-2"></i>Cập nhật trạng thái
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái mới</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-check me-2"></i>Cập nhật
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- @if($order->status === 'returning')
        @php
            $returnRequest = \App\Models\ReturnRequest::where('order_id', $order->id)->latest()->first();
        @endphp
        @if($returnRequest)
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <i class="fas fa-undo me-2"></i>Phiếu yêu cầu đổi trả
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Khách hàng:</strong> {{ $returnRequest->user->name }}<br>
                        <strong>Email:</strong> {{ $returnRequest->user->email }}<br>
                        <strong>Thời gian gửi:</strong> {{ $returnRequest->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Lý do đổi trả:</strong><br>
                        <span>{{ $returnRequest->reason }}</span>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Sản phẩm yêu cầu đổi trả:</strong>
                    <ul>
                        @foreach($order->items as $item)
                            @if(in_array($item->product_id, $returnRequest->product_ids))
                            <li class="mb-2 d-flex align-items-center">
                                @if($item->product->image)
                                <img src="{{ asset('img/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail me-2" style="width:40px;height:40px;object-fit:cover;">
                                @endif
                                <span>{{ $item->product->name }} x {{ $item->quantity }} - {{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @if($returnRequest->images && count($returnRequest->images))
                <div class="mb-3">
                    <strong>Ảnh minh họa:</strong><br>
                    @foreach($returnRequest->images as $img)
                        <a href="{{ asset('storage/' . $img) }}" target="_blank">
                            <img src="{{ asset('storage/' . $img) }}" style="width:80px;height:80px;object-fit:cover;margin:4px;" class="img-thumbnail">
                        </a>
                    @endforeach
                </div>
                @endif
                <div class="d-flex gap-2">
                    <form action="{{ route('admin.orders.return.approve', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i> Xác nhận đổi trả</button>
                    </form>
                    <form action="{{ route('admin.orders.return.reject', $order->id) }}" method="POST">
                        @csrf
                        <input type="text" name="admin_reason" class="form-control d-inline-block w-auto me-2" placeholder="Lý do từ chối" required style="max-width:200px;display:inline-block;">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times me-1"></i> Từ chối</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endif --}}
</div>
@endsection

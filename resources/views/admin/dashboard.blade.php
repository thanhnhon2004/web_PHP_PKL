@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Sản phẩm</h6>
                        <h2 class="mb-0">{{ \App\Models\Product::count() }}</h2>
                    </div>
                    <i class="fas fa-box fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background-color: #198754;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Đơn hàng</h6>
                        <h2 class="mb-0">{{ \App\Models\Order::count() }}</h2>
                    </div>
                    <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background-color: #0dcaf0;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Người dùng</h6>
                        <h2 class="mb-0">{{ \App\Models\User::count() }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background-color: #dc3545;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Doanh thu</h6>
                        <h2 class="mb-0">{{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                        <small>VNĐ</small>
                    </div>
                    <i class="fas fa-money-bill-wave fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Biểu đồ doanh thu theo tháng -->
<div class="row g-4 mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-chart-line me-2"></i><strong>Biểu đồ doanh thu 12 tháng</strong>
                </div>
                <a href="{{ route('admin.reports.export') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-download me-1"></i>Xuất báo cáo
                </a>
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-history me-2"></i>Đơn hàng gần đây
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Order::with('user')->latest()->take(5)->get() as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Chưa có đơn hàng nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-fire me-2"></i>Sản phẩm bán chạy
            </div>
            <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                @forelse($topProducts as $key => $product)
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-warning me-2" style="background-color: #ffc107; font-size: 14px;">
                                #{{ $key + 1 }}
                            </span>
                            <strong class="text-dark">{{ $product->name }}</strong>
                        </div>
                        <small class="text-muted">
                            Bán: <strong>{{ $product->total_sold }}</strong> |
                            Doanh thu: <strong>{{ number_format($product->total_revenue, 0, ',', '.') }} VNĐ</strong>
                        </small>
                    </div>
                    <div class="text-end">
                        <div class="progress" style="width: 60px; height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: {{ ($product->total_sold / $topProducts[0]->total_sold) * 100 }}%">
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-muted">Chưa có dữ liệu sản phẩm bán chạy</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Biểu đồ doanh thu theo tháng
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chartData = {!! $monthlyRevenue['chart_data'] !!};
    
    new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 14 },
                        padding: 20
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND',
                                maximumFractionDigits: 0
                            }).format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

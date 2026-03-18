<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        // Thống kê doanh thu theo tháng (12 tháng gần nhất)
        $monthlyRevenue = $this->getMonthlyRevenue();

        // Top 10 sản phẩm bán chạy
        $topProducts = $this->getTopSellingProducts();

        // Tổng doanh thu
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // Doanh thu tháng hiện tại
        $currentMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        return view('admin.dashboard', compact(
            'monthlyRevenue',
            'topProducts',
            'totalRevenue',
            'currentMonthRevenue'
        ));
    }

    /**
     * Lấy dữ liệu doanh thu theo tháng (12 tháng gần nhất)
     */
    private function getMonthlyRevenue()
    {
        $months = [];
        $revenues = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('m/Y');
            $months[] = $monthKey;

            $revenue = Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_price');

            $revenues[] = (float) $revenue;
        }

        return [
            'months' => $months,
            'revenues' => $revenues,
            'chart_data' => json_encode([
                'labels' => $months,
                'datasets' => [
                    [
                        'label' => 'Doanh thu (VNĐ)',
                        'data' => $revenues,
                        'borderColor' => 'rgb(75, 192, 192)',
                        'backgroundColor' => 'rgba(75, 192, 192, 0.1)',
                        'fill' => true,
                        'tension' => 0.4,
                    ]
                ]
            ])
        ];
    }

    /**
     * Lấy top 10 sản phẩm bán chạy
     */
    private function getTopSellingProducts()
    {
        return OrderItem::select(
                'products.id',
                'products.name',
                'products.price',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();
    }
}

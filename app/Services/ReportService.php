<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportService
{
    /**
     * Lấy dữ liệu báo cáo doanh thu theo tháng
     */
    public function getMonthlyRevenueReport()
    {
        $months = [];
        $revenues = [];
        $orderCounts = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('m/Y');
            $months[] = $monthKey;

            $revenue = Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_price');

            $orderCount = Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            $revenues[] = (float) $revenue;
            $orderCounts[] = $orderCount;
        }

        return [
            'months' => $months,
            'revenues' => $revenues,
            'orderCounts' => $orderCounts,
        ];
    }

    /**
     * Lấy top sản phẩm bán chạy
     */
    public function getTopSellingProducts($limit = 10)
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
            ->limit($limit)
            ->get();
    }

    /**
     * Lấy thông tin tóm tắt báo cáo
     */
    public function getSummaryReport()
    {
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $totalOrders = Order::where('status', 'completed')->count();
        $currentMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');
        
        $lastMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_price');

        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;

        return [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'currentMonthRevenue' => $currentMonthRevenue,
            'lastMonthRevenue' => $lastMonthRevenue,
            'revenueGrowth' => $revenueGrowth,
            'generatedAt' => now()->format('d/m/Y H:i:s'),
        ];
    }
}

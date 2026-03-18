<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data)
    {
        if (!isset($data['total_price']) && isset($data['total_amount'])) {
            $data['total_price'] = $data['total_amount'];
            unset($data['total_amount']);
        }

        return Order::create($data);
    }

    public function updateStatus(int $orderId, string $status)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        return $order;
    }

    public function getByUser(int $userId)
    {
        return Order::with('items.product')->where('user_id', $userId)->get();
    }
}

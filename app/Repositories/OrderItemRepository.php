<?php

namespace App\Repositories;

use App\Models\OrderItem;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function add(array $data)
    {
        return OrderItem::create($data);
    }

    public function allByOrder(int $orderId)
    {
        return OrderItem::with('product')->where('order_id', $orderId)->get();
    }
}

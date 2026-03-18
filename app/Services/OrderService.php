<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;

class OrderService
{
    protected $orderRepo;
    protected $orderItemRepo;

    public function __construct(OrderRepositoryInterface $orderRepo, OrderItemRepositoryInterface $orderItemRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
    }

    public function createOrder($userId, array $items, $totalPrice)
    {
        $order = $this->orderRepo->create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        foreach ($items as $item) {
            $this->orderItemRepo->add([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return $order->load('items.product');
    }

    public function updateOrderStatus($orderId, $status)
    {
        return $this->orderRepo->updateStatus($orderId, $status);
    }

    public function getOrdersByUser($userId)
    {
        return $this->orderRepo->getByUser($userId);
    }
}

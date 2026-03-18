<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderItemRepositoryInterface;

class OrderItemService
{
    protected $orderItemRepo;

    public function __construct(OrderItemRepositoryInterface $orderItemRepo)
    {
        $this->orderItemRepo = $orderItemRepo;
    }

    public function getItemsByOrder($orderId)
    {
        return $this->orderItemRepo->allByOrder($orderId);
    }
}

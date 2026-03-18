<?php

namespace App\Repositories\Interfaces;

interface OrderItemRepositoryInterface
{
    public function add(array $data);

    public function allByOrder(int $orderId);
}

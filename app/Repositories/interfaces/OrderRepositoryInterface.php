<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function create(array $data);

    public function updateStatus(int $orderId, string $status);

    public function getByUser(int $userId);
}

<?php

namespace App\Repositories\Interfaces;

interface CartItemRepositoryInterface
{
    public function allByCart(int $cartId);

    public function add(array $data);

    public function updateQuantity(int $itemId, int $quantity);

    public function delete(int $itemId);
}

<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function getByUser(int $userId)
    {
        return Cart::firstOrCreate(['user_id' => $userId])->load('items.product');
    }
}

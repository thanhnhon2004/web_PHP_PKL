<?php

namespace App\Repositories;

use App\Models\CartItem;
use App\Repositories\Interfaces\CartItemRepositoryInterface;

class CartItemRepository implements CartItemRepositoryInterface
{
    public function allByCart(int $cartId)
    {
        return CartItem::with('product')->where('cart_id', $cartId)->get();
    }

    public function add(array $data)
    {
        return CartItem::create($data);
    }

    public function updateQuantity(int $itemId, int $quantity)
    {
        $item = CartItem::findOrFail($itemId);
        $item->update(['quantity' => $quantity]);
        return $item;
    }

    public function delete(int $itemId)
    {
        return CartItem::destroy($itemId);
    }
}

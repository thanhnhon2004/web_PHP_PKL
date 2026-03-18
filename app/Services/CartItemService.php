<?php

namespace App\Services;

use App\Repositories\Interfaces\CartItemRepositoryInterface;

class CartItemService
{
    protected $cartItemRepo;

    public function __construct(CartItemRepositoryInterface $cartItemRepo)
    {
        $this->cartItemRepo = $cartItemRepo;
    }

    public function getItemsByCart($cartId)
    {
        return $this->cartItemRepo->allByCart($cartId);
    }

    public function addItemToCart($cartId, $productId, $quantity)
    {
        return $this->cartItemRepo->add([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    public function updateItemQuantity($itemId, $quantity)
    {
        return $this->cartItemRepo->updateQuantity($itemId, $quantity);
    }

    public function removeItem($itemId)
    {
        return $this->cartItemRepo->delete($itemId);
    }
}

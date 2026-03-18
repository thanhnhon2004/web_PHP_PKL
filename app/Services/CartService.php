<?php

namespace App\Services;

use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\CartItemRepositoryInterface;

class CartService
{
    protected $cartRepo;
    protected $cartItemRepo;

    public function __construct(CartRepositoryInterface $cartRepo, CartItemRepositoryInterface $cartItemRepo)
    {
        $this->cartRepo = $cartRepo;
        $this->cartItemRepo = $cartItemRepo;
    }

    public function getCartByUser($userId)
    {
        return $this->cartRepo->getByUser($userId);
    }

    public function addProductToCart($cartId, $productId, $quantity)
    {
        return $this->cartItemRepo->add([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    public function updateQuantity($itemId, $quantity)
    {
        return $this->cartItemRepo->updateQuantity($itemId, $quantity);
    }

    public function removeItem($itemId)
    {
        return $this->cartItemRepo->delete($itemId);
    }
}

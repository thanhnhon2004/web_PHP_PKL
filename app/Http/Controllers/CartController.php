<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = $this->cartService->getCartByUser(Auth::id());
        return view('cart.index', compact('cart'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->cartService->getCartByUser(Auth::id());
        
        $this->cartService->addProductToCart(
            $cart->id,
            $request->product_id,
            $request->quantity
        );

        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $this->cartService->updateQuantity($itemId, $request->quantity);
            
            // Nếu là AJAX request, return JSON
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã cập nhật giỏ hàng!'
                ]);
            }
            
            // Nếu là form submission thông thường, redirect
            return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng!');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 400);
            }
            
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($itemId)
    {
        $this->cartService->removeItem($itemId);
        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}

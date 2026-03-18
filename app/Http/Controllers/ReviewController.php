<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $orderId, $productId)
    {
        $order = Order::findOrFail($orderId);
        $product = Product::findOrFail($productId);
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'review_images.*' => 'nullable|image|max:4096',
        ]);
        $imagePaths = [];
        if ($request->hasFile('review_images')) {
            foreach ($request->file('review_images') as $file) {
                if ($file && $file->isValid()) {
                    $imagePaths[] = $file->store('reviews', 'public');
                }
            }
        }
        // Kiểm tra đã đánh giá sản phẩm này trong đơn này chưa
        $exists = Review::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('order_id', $order->id)
            ->exists();
        if ($exists) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này trong đơn hàng này rồi!');
        }
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'images' => $imagePaths,
        ]);
        return back()->with('success', 'Đã gửi đánh giá sản phẩm!');
    }
}

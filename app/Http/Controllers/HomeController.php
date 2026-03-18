<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Album;

class HomeController extends Controller
{
    // Hiển thị trang chủ
    public function index()
    {
        $featuredProducts = Product::with(['category', 'brand', 'images'])
            ->latest()
            ->take(6)
            ->get();
        
        $categories = Category::withCount('products')->get();
        
        $recentAlbums = Album::with('images')
            ->latest()
            ->take(3)
            ->get();
        
        return view('home', compact('featuredProducts', 'categories', 'recentAlbums'));
    }
}

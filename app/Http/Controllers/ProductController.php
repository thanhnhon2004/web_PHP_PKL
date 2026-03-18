<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Models\Album;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Hiển thị danh sách sản phẩm với filter
    public function index(Request $request)
    {
        // Lấy filters từ request
        $filters = $request->only(['search', 'category_id', 'brand_id', 'max_price', 'sort']);
        
        // Check if có filter nào được apply
        $hasFilters = !empty(array_filter($filters));
        
        // Get products
        if ($hasFilters) {
            $products = $this->productService->filterProducts($filters, 6);
        } else {
            $products = $this->productService->getAllProducts(6);
        }

        // Get data cho filters
        $categories = Category::all();
        $brands = Brand::all();
        $maxPrice = $this->productService->getMaxPrice();
        $priceStats = $this->productService->getPriceStats();
        
        return view('products.index', compact(
            'products', 
            'categories', 
            'brands', 
            'maxPrice', 
            'priceStats'
        ));
    }

    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        $product = $this->productService->getProductDetail($id);
        
        if (!$product) {
            abort(404, 'Sản phẩm không tồn tại');
        }

        return view('products.show', compact('product'));
    }

    // Hiển thị danh sách album
    public function albums()
    {
        $albums = Album::with('images')->latest()->paginate(12);
        return view('albums.index', compact('albums'));
    }

    // Hiển thị chi tiết album
    public function albumDetail($id)
    {
        $album = Album::with('images')->findOrFail($id);
        return view('albums.show', compact('album'));
    }
}

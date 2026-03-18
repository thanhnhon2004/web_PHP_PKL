<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ImageUploadService;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $imageUploadService;

    public function __construct(
        ProductService $productService, 
        CategoryService $categoryService,
        ImageUploadService $imageUploadService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->imageUploadService = $imageUploadService;
    }

    // Hiển thị danh sách sản phẩm (Admin)
    public function index()
    {
        // Paginate để dùng được ->links() trong view admin
        $products = Product::with(['brand', 'category', 'images'])->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        
        // Xử lý upload ảnh sử dụng ImageUploadService
        if ($request->hasFile('image')) {
            $imageName = $this->imageUploadService->uploadAndResize(
                $request->file('image'), 
                'products', 
                $request->name
            );
            $data['image'] = $imageName;
        }

        $this->productService->createProduct($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Đã thêm sản phẩm mới!');
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $product = $this->productService->getProductDetail($id);
        $categories = $this->categoryService->getAllCategories();
        $brands = Brand::all();
        
        if (!$product) {
            abort(404, 'Sản phẩm không tồn tại');
        }

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);

        $product = $this->productService->getProductDetail($id);
        if (!$product) {
            abort(404, 'Sản phẩm không tồn tại');
        }

        $data = $request->all();
        
        // Xử lý upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($product->image) {
                $this->imageUploadService->delete($product->image, 'products');
            }
            
            $imageName = $this->imageUploadService->uploadAndResize(
                $request->file('image'), 
                'products', 
                $request->name
            );
            $data['image'] = $imageName;
        } else {
            // Không có file mới, giữ ảnh cũ
            unset($data['image']);
        }

        $product->update($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật sản phẩm!');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = $this->productService->getProductDetail($id);
        
        if (!$product) {
            abort(404, 'Sản phẩm không tồn tại');
        }

        // Xóa ảnh khi xóa sản phẩm
        if ($product->image) {
            $this->imageUploadService->delete($product->image, 'products');
        }

        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}

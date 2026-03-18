<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

/**
 * ProductFilterService - Xử lý logic filter sản phẩm
 * Áp dụng Single Responsibility Principle (SRP)
 * Tách biệt logic filter khỏi Repository
 */
class ProductFilterService
{
    /**
     * Build query với các filters
     * 
     * @param array $filters
     * @return Builder
     */
    public function buildFilterQuery(array $filters): Builder
    {
        $query = Product::query()->with(['brand', 'category', 'images']);

        // Filter by search keyword
        if (!empty($filters['search'])) {
            $this->applySearchFilter($query, $filters['search']);
        }

        // Filter by category
        if (!empty($filters['category_id'])) {
            $this->applyCategoryFilter($query, $filters['category_id']);
        }

        // Filter by brand
        if (!empty($filters['brand_id'])) {
            $this->applyBrandFilter($query, $filters['brand_id']);
        }

        // Filter by price range
        if (!empty($filters['max_price'])) {
            $this->applyPriceFilter($query, $filters['max_price']);
        }

        // Sort
        $this->applySorting($query, $filters['sort'] ?? 'latest');

        return $query;
    }

    /**
     * Apply search filter (tìm theo tên, mô tả)
     */
    protected function applySearchFilter(Builder $query, string $search): void
    {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereHas('brand', function ($brandQuery) use ($search) {
                  $brandQuery->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('category', function ($categoryQuery) use ($search) {
                  $categoryQuery->where('name', 'like', "%{$search}%");
              });
        });
    }

    /**
     * Apply category filter
     */
    /**
     * Apply category filter (multi-category)
     */
    protected function applyCategoryFilter(Builder $query, $categoryId): void
    {
        // Nếu là mảng, lọc theo nhiều danh mục
        if (is_array($categoryId)) {
            // Loại bỏ giá trị rỗng (checkbox "Tất cả danh mục")
            $categoryId = array_filter($categoryId);
            if (!empty($categoryId)) {
                $query->whereIn('category_id', $categoryId);
            }
            // Nếu mảng rỗng, không filter (tất cả danh mục)
        } else if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }
        // Nếu không có categoryId, không filter
    }

    /**
     * Apply brand filter
     */
    protected function applyBrandFilter(Builder $query, int $brandId): void
    {
        $query->where('brand_id', $brandId);
    }

    /**
     * Apply price filter (0 đến max_price)
     */
    protected function applyPriceFilter(Builder $query, float $maxPrice): void
    {
        $query->where('price', '<=', $maxPrice);
    }

    /**
     * Apply sorting
     */
    protected function applySorting(Builder $query, string $sort): void
    {
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }
    }

    /**
     * Get max price in database (để set range slider)
     */
    public function getMaxPrice(): float
    {
        return Product::max('price') ?? 100000000; // Default 100 triệu
    }

    /**
     * Get price statistics
     */
    public function getPriceStats(): array
    {
        return [
            'min' => Product::min('price') ?? 0,
            'max' => Product::max('price') ?? 100000000,
            'avg' => Product::avg('price') ?? 0,
        ];
    }
}

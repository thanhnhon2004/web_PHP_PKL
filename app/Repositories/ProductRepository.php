<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($perPage = 15)
    {
        return Product::with(['brand', 'category', 'images'])->paginate($perPage);
    }

    public function find(int $id)
    {
        return Product::with(['brand', 'category', 'images'])->find($id);
    }

    /**
     * Filter products with query builder
     * @param Builder $query
     * @param int $perPage
     * @return mixed
     */
    public function filterWithQuery(Builder $query, int $perPage = 15)
    {
        return $query->paginate($perPage);
    }

    public function filterByPrice(float $min, float $max, $perPage = 15)
    {
        return Product::with(['brand', 'category', 'images'])
            ->whereBetween('price', [$min, $max])
            ->paginate($perPage);
    }

    public function filterByBrand(string $brand, $perPage = 15)
    {
        return Product::with(['brand', 'category', 'images'])
            ->when(is_numeric($brand), function ($query) use ($brand) {
                $query->where('brand_id', $brand);
            }, function ($query) use ($brand) {
                $query->whereHas('brand', function ($q) use ($brand) {
                    $q->where('name', $brand);
                });
            })
            ->paginate($perPage);
    }

    public function filterByCategory(int $categoryId, $perPage = 15)
    {
        return Product::with(['brand', 'category', 'images'])
            ->where('category_id', $categoryId)
            ->paginate($perPage);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(int $id, array $data)
    {
        $product = $this->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete(int $id)
    {
        $product = $this->find($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}

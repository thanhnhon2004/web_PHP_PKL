<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\ProductFilterService;

class ProductService
{
    protected $productRepo;
    protected $filterService;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        ProductFilterService $filterService
    ) {
        $this->productRepo = $productRepo;
        $this->filterService = $filterService;
    }

    public function getAllProducts($perPage = 15)
    {
        return $this->productRepo->all($perPage);
    }

    public function getProductDetail($id)
    {
        return $this->productRepo->find($id);
    }

    /**
     * Filter products using ProductFilterService
     */
    public function filterProducts(array $filters, $perPage = 15)
    {
        $query = $this->filterService->buildFilterQuery($filters);
        return $query->paginate($perPage);
    }

    /**
     * Get max price for range slider
     */
    public function getMaxPrice(): float
    {
        return $this->filterService->getMaxPrice();
    }

    /**
     * Get price statistics
     */
    public function getPriceStats(): array
    {
        return $this->filterService->getPriceStats();
    }

    public function createProduct(array $data)
    {
        return $this->productRepo->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepo->update($id, $data);
    }
}

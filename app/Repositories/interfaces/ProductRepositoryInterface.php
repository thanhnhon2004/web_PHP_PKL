<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function filterByPrice(float $min, float $max);

    public function filterByBrand(string $brand);

    public function filterByCategory(int $categoryId);

    public function create(array $data);

    public function update(int $id, array $data);
}

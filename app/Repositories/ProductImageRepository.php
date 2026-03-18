<?php

namespace App\Repositories;

use App\Models\ProductImage;
use App\Repositories\Interfaces\ProductImageRepositoryInterface;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    public function create(array $data)
    {
        return ProductImage::create($data);
    }

    public function delete(int $id)
    {
        return ProductImage::destroy($id);
    }
}

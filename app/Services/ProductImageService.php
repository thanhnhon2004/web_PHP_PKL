<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductImageRepositoryInterface;

class ProductImageService
{
    protected $imageRepo;

    public function __construct(ProductImageRepositoryInterface $imageRepo)
    {
        $this->imageRepo = $imageRepo;
    }

    public function addImage(array $data)
    {
        return $this->imageRepo->create($data);
    }

    public function deleteImage($id)
    {
        return $this->imageRepo->delete($id);
    }
}

<?php

namespace App\Repositories\Interfaces;

interface ProductImageRepositoryInterface
{
    public function create(array $data);

    public function delete(int $id);
}

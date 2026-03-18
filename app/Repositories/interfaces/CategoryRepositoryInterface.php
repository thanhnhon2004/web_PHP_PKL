<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function all();

    public function create(array $data);
}

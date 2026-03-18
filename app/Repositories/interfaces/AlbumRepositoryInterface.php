<?php

namespace App\Repositories\Interfaces;

interface AlbumRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function create(array $data);
}

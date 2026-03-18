<?php

namespace App\Repositories;

use App\Models\Album;
use App\Repositories\Interfaces\AlbumRepositoryInterface;

class AlbumRepository implements AlbumRepositoryInterface
{
    public function all()
    {
        return Album::with('images')->get();
    }

    public function find(int $id)
    {
        return Album::with('images')->find($id);
    }

    public function create(array $data)
    {
        return Album::create($data);
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\AlbumRepositoryInterface;

class AlbumService
{
    protected $albumRepo;

    public function __construct(AlbumRepositoryInterface $albumRepo)
    {
        $this->albumRepo = $albumRepo;
    }

    public function getAllAlbums()
    {
        return $this->albumRepo->all();
    }

    public function getAlbumDetail($id)
    {
        return $this->albumRepo->find($id);
    }

    public function createAlbum(array $data)
    {
        return $this->albumRepo->create($data);
    }
}

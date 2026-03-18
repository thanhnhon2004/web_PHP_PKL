<?php

namespace App\Services;

use App\Repositories\Interfaces\AlbumImageRepositoryInterface;
//Service là lớp xử lý nghiệp vụ (business logic), 
//dùng để kết hợp nhiều Repository, xử lý quy trình, điều kiện,
// và luật nghiệp vụ của hệ thống.
class AlbumImageService
{
    protected $albumImageRepo;

    public function __construct(AlbumImageRepositoryInterface $albumImageRepo)
    {
        $this->albumImageRepo = $albumImageRepo;
    }

    public function addImage(array $data)
    {
        return $this->albumImageRepo->create($data);
    }

    public function deleteImage($id)
    {
        return $this->albumImageRepo->delete($id);
    }
}

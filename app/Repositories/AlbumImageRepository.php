<?php

namespace App\Repositories;

use App\Models\AlbumImage;
use App\Repositories\Interfaces\AlbumImageRepositoryInterface;
// “repository dùng để truy suất dữ liệu từ model tới controller
// và truy xuất như thế nào thì interface quy định”
class AlbumImageRepository implements AlbumImageRepositoryInterface
{
    public function create(array $data)
    {
        return AlbumImage::create($data);
    }

    public function delete(int $id)
    {
        return AlbumImage::destroy($id);
    }
}

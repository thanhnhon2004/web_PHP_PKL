<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Album;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            [
                'title' => 'Wedding Photography 2024',
                'photographer_name' => 'Phan Hoàng Linh',
                'image' => 'album-wedding.jpg',
            ],
            [
                'title' => 'Landscape Vietnam',
                'photographer_name' => 'Kim Trúc',
                'image' => 'album-landscape.jpg',
            ],
            [
                'title' => 'Street Photography Saigon',
                'photographer_name' => 'Trương Hoàng Nam',
                'image' => 'album-street.jpg',
            ],
            [
                'title' => 'Portrait Collection',
                'photographer_name' => 'Phan Hoàng Linh',
                'image' => 'album-portrait.jpg',
            ],
        ];

        foreach ($albums as $album) {
            Album::create($album);
        }
    }
}

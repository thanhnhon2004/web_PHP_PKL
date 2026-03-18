<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Máy ảnh'],
            ['name' => 'Ống kính'],
            ['name' => 'Phụ kiện'],
            ['name' => 'Đèn flash'],
            ['name' => 'Tripod & Gimbal'],
            ['name' => 'Túi đựng'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}

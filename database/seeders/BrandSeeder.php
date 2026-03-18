<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Canon'],
            ['name' => 'Nikon'],
            ['name' => 'Sony'],
            ['name' => 'Fujifilm'],
            ['name' => 'Panasonic'],
            ['name' => 'Olympus'],
            ['name' => 'Leica'],
            ['name' => 'DJI'],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate($brand);
        }
    }
}

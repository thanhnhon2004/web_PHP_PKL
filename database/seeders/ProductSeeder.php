<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $canon = Brand::where('name', 'Canon')->first();
        $nikon = Brand::where('name', 'Nikon')->first();
        $sony = Brand::where('name', 'Sony')->first();
        $fuji = Brand::where('name', 'Fujifilm')->first();
        $panasonic = Brand::where('name', 'Panasonic')->first();
        $olympus = Brand::where('name', 'Olympus')->first();
        $leica = Brand::where('name', 'Leica')->first();
        $dji = Brand::where('name', 'DJI')->first();

        $camera = Category::where('name', 'Máy ảnh')->first();
        $lens = Category::where('name', 'Ống kính')->first();
        $accessory = Category::where('name', 'Phụ kiện')->first();

        $products = [
            [
                'name' => 'Canon EOS R5',
                'price' => 89900000,
                'description' => 'Máy ảnh Full-frame mirrorless cao cấp với cảm biến 45MP, quay video 8K',
                'image' => 'canon-r5.jpg',
                'brand_id' => $canon->id,
                'category_id' => $camera->id,
                'stock' => 15,
            ],
            [
                'name' => 'Nikon Z9',
                'price' => 99900000,
                'description' => 'Máy ảnh mirrorless chuyên nghiệp, cảm biến 45.7MP, chụp liên tục 20fps',
                'image' => 'nikon-z9.jpg',
                'brand_id' => $nikon->id,
                'category_id' => $camera->id,
                'stock' => 8,
            ],
            [
                'name' => 'Sony A7 IV',
                'price' => 62000000,
                'description' => 'Máy ảnh Full-frame đa năng, 33MP, quay video 4K 60fps',
                'image' => 'sony-a7iv.jpg',
                'brand_id' => $sony->id,
                'category_id' => $camera->id,
                'stock' => 20,
            ],
            [
                'name' => 'Fujifilm X-T5',
                'price' => 48000000,
                'description' => 'Máy ảnh APS-C 40MP với thiết kế cổ điển, chất lượng màu Fujifilm',
                'image' => 'fuji-xt5.jpg',
                'brand_id' => $fuji->id,
                'category_id' => $camera->id,
                'stock' => 12,
            ],
            [
                'name' => 'Canon RF 24-70mm f/2.8L IS',
                'price' => 55000000,
                'description' => 'Ống kính zoom chuẩn chuyên nghiệp cho Canon RF mount',
                'image' => 'canon-rf-24-70.jpg',
                'brand_id' => $canon->id,
                'category_id' => $lens->id,
                'stock' => 18,
            ],
            [
                'name' => 'Nikon Z 85mm f/1.8 S',
                'price' => 19900000,
                'description' => 'Ống kính chân dung với khẩu độ lớn, chất lượng hình ảnh tuyệt vời',
                'image' => 'nikon-z-85mm.jpg',
                'brand_id' => $nikon->id,
                'category_id' => $lens->id,
                'stock' => 25,
            ],
            [
                'name' => 'Sony FE 70-200mm f/2.8 GM II',
                'price' => 68000000,
                'description' => 'Ống kính tele zoom chuyên nghiệp thế hệ mới',
                'image' => 'sony-70-200.jpg',
                'brand_id' => $sony->id,
                'category_id' => $lens->id,
                'stock' => 10,
            ],
            [
                'name' => 'Manfrotto MT055XPRO3',
                'price' => 8500000,
                'description' => 'Chân máy nhôm chuyên nghiệp, tải trọng 9kg',
                'image' => 'manfrotto-tripod.jpg',
                'brand_id' => $canon->id,
                'category_id' => $accessory->id,
                'stock' => 30,
            ],
            [
                'name' => 'Peak Design Everyday Backpack 30L',
                'price' => 6500000,
                'description' => 'Balo đựng máy ảnh cao cấp, thiết kế thông minh',
                'image' => 'peak-design-bag.jpg',
                'brand_id' => $sony->id,
                'category_id' => $accessory->id,
                'stock' => 40,
            ],
            [
                'name' => 'SanDisk Extreme Pro 128GB',
                'price' => 1200000,
                'description' => 'Thẻ nhớ SD tốc độ cao 170MB/s, dung lượng 128GB',
                'image' => 'sandisk-sd.jpg',
                'brand_id' => $canon->id,
                'category_id' => $accessory->id,
                'stock' => 100,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $brandProductCatalog = [
            'Sony' => [
                [
                    'name' => 'Sony A7R V',
                    'price' => 98000000,
                    'description' => 'Máy ảnh full-frame 61MP, lấy nét AI thông minh, quay 8K',
                    'image' => null,
                ],
                [
                    'name' => 'Sony A6700',
                    'price' => 41000000,
                    'description' => 'Máy ảnh APS-C 26MP, quay 4K 120p, chống rung 5 trục',
                    'image' => null,
                ],
                [
                    'name' => 'Sony ZV-E1',
                    'price' => 56000000,
                    'description' => 'Máy ảnh vlog full-frame nhỏ gọn, tối ưu quay video',
                    'image' => null,
                ],
                [
                    'name' => 'Sony A1',
                    'price' => 99000000,
                    'description' => 'Máy ảnh flagship 50MP, chụp 30fps, quay 8K',
                    'image' => null,
                ],
            ],
            'Panasonic' => [
                [
                    'name' => 'Panasonic Lumix S5 II',
                    'price' => 47000000,
                    'description' => 'Máy ảnh full-frame, lấy nét pha lai, quay 6K',
                    'image' => null,
                ],
                [
                    'name' => 'Panasonic Lumix GH6',
                    'price' => 52000000,
                    'description' => 'Máy ảnh Micro Four Thirds, quay 5.7K, chống rung mạnh',
                    'image' => null,
                ],
                [
                    'name' => 'Panasonic Lumix G9 II',
                    'price' => 46000000,
                    'description' => 'Máy ảnh MFT hiệu năng cao, quay 5.8K, lấy nét nhanh',
                    'image' => null,
                ],
                [
                    'name' => 'Panasonic Lumix S1R',
                    'price' => 83000000,
                    'description' => 'Máy ảnh full-frame 47MP, chất lượng ảnh tĩnh vượt trội',
                    'image' => null,
                ],
            ],
            'Olympus' => [
                [
                    'name' => 'OM SYSTEM OM-1',
                    'price' => 52000000,
                    'description' => 'Máy ảnh MFT cao cấp, chống rung 8 stops, chống thời tiết',
                    'image' => null,
                ],
                [
                    'name' => 'Olympus OM-D E-M10 Mark IV',
                    'price' => 20000000,
                    'description' => 'Máy ảnh MFT nhỏ gọn, phù hợp du lịch và người mới',
                    'image' => null,
                ],
                [
                    'name' => 'Olympus OM-D E-M1 Mark III',
                    'price' => 42000000,
                    'description' => 'Máy ảnh MFT chuyên nghiệp, chụp liên tục nhanh',
                    'image' => null,
                ],
                [
                    'name' => 'OM SYSTEM OM-5',
                    'price' => 32000000,
                    'description' => 'Máy ảnh MFT chống thời tiết, gọn nhẹ, đa dụng',
                    'image' => null,
                ],
            ],
            'Leica' => [
                [
                    'name' => 'Leica Q3',
                    'price' => 99000000,
                    'description' => 'Máy ảnh compact full-frame 60MP, ống kính 28mm f/1.7',
                    'image' => null,
                ],
                [
                    'name' => 'Leica SL2',
                    'price' => 98000000,
                    'description' => 'Máy ảnh full-frame 47MP, thân máy chắc chắn, chống thời tiết',
                    'image' => null,
                ],
                [
                    'name' => 'Leica M11',
                    'price' => 99000000,
                    'description' => 'Máy ảnh rangefinder full-frame 60MP, thiết kế cổ điển',
                    'image' => null,
                ],
                [
                    'name' => 'Leica D-Lux 7',
                    'price' => 32000000,
                    'description' => 'Máy ảnh compact cảm biến lớn, ống kính Leica DC',
                    'image' => null,
                ],
            ],
            'DJI' => [
                [
                    'name' => 'DJI Osmo Pocket 3',
                    'price' => 14500000,
                    'description' => 'Camera gimbal bỏ túi, cảm biến 1-inch, quay 4K 120fps',
                    'image' => null,
                ],
                [
                    'name' => 'DJI Osmo Action 4',
                    'price' => 9500000,
                    'description' => 'Action camera cảm biến 1/1.3-inch, quay 4K 120fps',
                    'image' => null,
                ],
                [
                    'name' => 'DJI Mavic 3 Classic',
                    'price' => 36000000,
                    'description' => 'Drone cảm biến 4/3, quay 5.1K, thời gian bay dài',
                    'image' => null,
                ],
                [
                    'name' => 'DJI Air 3',
                    'price' => 28000000,
                    'description' => 'Drone camera kép, quay 4K 100fps, pin lâu',
                    'image' => null,
                ],
            ],
        ];

        $brandMap = [
            'Sony' => $sony,
            'Panasonic' => $panasonic,
            'Olympus' => $olympus,
            'Leica' => $leica,
            'DJI' => $dji,
        ];

        foreach ($brandProductCatalog as $brandName => $items) {
            $brand = $brandMap[$brandName] ?? null;
            if (!$brand || !$camera) {
                continue;
            }

            $count = rand(2, 4);
            $selectedIndexes = array_rand($items, $count);
            $selectedIndexes = is_array($selectedIndexes) ? $selectedIndexes : [$selectedIndexes];

            foreach ($selectedIndexes as $index) {
                $item = $items[$index];
                Product::create([
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'description' => $item['description'],
                    'image' => $item['image'],
                    'brand_id' => $brand->id,
                    'category_id' => $camera->id,
                    'stock' => rand(5, 30),
                ]);
            }
        }
    }
}

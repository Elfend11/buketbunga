<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Task ID: DB-024 — Starter Catalog Products
     */
    public function run(): void
    {
        $freshCat = Category::where('slug', 'buket-bunga-segar')->first();
        $dryCat = Category::where('slug', 'buket-bunga-kering-artificial')->first();
        $snackCat = Category::where('slug', 'buket-snack-cokelat')->first();

        $products = [
            [
                'category_id' => $freshCat?->id,
                'name' => 'Pastel Dream Bouquet',
                'price' => 220000.00,
                'description' => 'Kombinasi 10 tangkai mawar pastel blush pink, bunga baby\'s breath segar, dan pembungkus kertas Korean cellophane bernuansa lembut.',
                'image_path' => 'products/pastel-dream.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => $freshCat?->id,
                'name' => 'Mawar Merona Elegance',
                'price' => 185000.00,
                'description' => 'Rangkaian 8 tangkai mawar merah semi-holland segar berpadu dengan wrapping hitam pekat bergaya rustic elegan.',
                'image_path' => 'products/mawar-merona.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => $dryCat?->id,
                'name' => 'Golden Autumn Preserved',
                'price' => 250000.00,
                'description' => 'Bunga gandum, lavender kering, dan bunga kapas abadi dengan pita emas satin yang awet disimpan bertahun-tahun.',
                'image_path' => 'products/golden-autumn.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => $snackCat?->id,
                'name' => 'Sweet Choco Delight',
                'price' => 150000.00,
                'description' => 'Rangkaian manis 5 cokelat batangan Ferrero Rocher & Silverqueen dengan ornamen bunga mini.',
                'image_path' => 'products/sweet-choco.jpg',
                'is_available' => true,
            ],
        ];

        foreach ($products as $prod) {
            if ($prod['category_id']) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($prod['name'])],
                    $prod
                );
            }
        }
    }
}


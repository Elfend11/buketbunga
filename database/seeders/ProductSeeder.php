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
     * Catatan: Data produk bersifat sampel awal [Perlu Konfirmasi Owner]
     */
    public function run(): void
    {
        $flowerCat = Category::where('slug', 'buket-bunga')->first();
        $snackCat = Category::where('slug', 'buket-snack')->first();

        $products = [
            [
                'category_id' => $flowerCat?->id,
                'name' => 'Pastel Dream Bouquet',
                'price' => 220000.00,
                'description' => 'Kombinasi 10 tangkai mawar pastel blush pink, bunga baby\'s breath segar, dan pembungkus kertas Korean cellophane bernuansa lembut.',
                'image_path' => 'products/pastel-dream.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => $flowerCat?->id,
                'name' => 'Mawar Merona Elegance',
                'price' => 185000.00,
                'description' => 'Rangkaian 8 tangkai mawar merah semi-holland segar berpadu dengan wrapping hitam pekat bergaya rustic elegan.',
                'image_path' => 'products/mawar-merona.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => $snackCat?->id,
                'name' => 'Sweet Choco Delight',
                'price' => 150000.00,
                'description' => 'Rangkaian manis kombinasi cokelat artisan dan camilan favorit berhias ornamen bunga mini.',
                'image_path' => 'products/sweet-choco.jpg',
                'is_available' => true,
            ],
        ];

        foreach ($products as $prod) {
            if (!empty($prod['category_id'])) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($prod['name'])],
                    $prod
                );
            }
        }
    }
}

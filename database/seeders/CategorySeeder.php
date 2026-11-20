<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Sesuai Dokumen Spesifikasi Basis Data v1.1 (Bagian 7)
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Buket Bunga',
                'slug' => 'buket-bunga',
                'description' => 'Koleksi buket bunga segar dan bunga artificial berkualitas tinggi untuk berbagai momen istimewa.',
                'is_active' => true,
            ],
            [
                'name' => 'Buket Uang',
                'slug' => 'buket-uang',
                'description' => 'Rangkaian buket uang asli dengan kertas pembungkus cellophane elegan bernilai estetika tinggi.',
                'is_active' => true,
            ],
            [
                'name' => 'Buket Snack',
                'slug' => 'buket-snack',
                'description' => 'Buket kreasi makanan ringan, permen, dan cokelat artisan favorit pilihan.',
                'is_active' => true,
            ],
            [
                'name' => 'Buket Boneka',
                'slug' => 'buket-boneka',
                'description' => 'Buket boneka wisuda, ulang tahun, dan karakter spesial untuk hadiah kelulusan atau perayaan.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}

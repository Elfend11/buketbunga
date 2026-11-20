<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Task ID: DB-024 — Category Master Seeder
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Buket Bunga Segar',
                'description' => 'Rangkaian bunga potong segar premium seperti mawar, lily, dan baby\'s breath yang dirangkai segar di Samarinda.',
            ],
            [
                'name' => 'Buket Bunga Kering & Artificial',
                'description' => 'Buket bunga preserved tahan bertahun-tahun yang abadi untuk momen wisuda dan perayaan khusus.',
            ],
            [
                'name' => 'Buket Uang (Money Bouquet)',
                'description' => 'Rangkaian buket uang asli bernilai estetika tinggi dengan kertas wrapping cellophane elegan.',
            ],
            [
                'name' => 'Buket Snack & Cokelat',
                'description' => 'Hadiah buket manis berisi kombinasi cokelat artisan dan camilan favorit.',
            ],
            [
                'name' => 'Buket Boneka & Wisuda',
                'description' => 'Buket perayaan wisuda lengkap dengan boneka toga kelulusan dan selempang nama kustom.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                ]
            );
        }
    }
}


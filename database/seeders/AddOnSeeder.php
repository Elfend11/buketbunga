<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AddOn;

class AddOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Sesuai Dokumen Spesifikasi Basis Data v1.1 (Bagian 4.8, 7)
     */
    public function run(): void
    {
        $addOns = [
            [
                'name' => 'Kartu Ucapan Custom Cetak',
                'price' => 5000.00,
                'description' => 'Kartu ucapan dengan pesan personal dicetak rapi menggunakan font elegan.',
                'image_path' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Topper Akrilik Tema',
                'price' => 15000.00,
                'description' => 'Topper akrilik ucapan pilihan: Happy Birthday, Graduation, atau Anniversary.',
                'image_path' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Boneka Wisuda Mini',
                'price' => 25000.00,
                'description' => 'Boneka beruang mini lengkap dengan toga dan selempang kelulusan.',
                'image_path' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Lampu LED String Fairy Lights',
                'price' => 15000.00,
                'description' => 'Untaian lampu LED mini warm white untuk efek bercahaya pada rangkaian buket.',
                'image_path' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Paper Bag Premium BLOOMÉ',
                'price' => 10000.00,
                'description' => 'Paper bag eksklusif berlogo resmi BLOOMÉ berbahan tebal ramah lingkungan.',
                'image_path' => null,
                'is_available' => true,
            ],
        ];

        foreach ($addOns as $item) {
            AddOn::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}


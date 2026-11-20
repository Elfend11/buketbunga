<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Sesuai Dokumen Spesifikasi Basis Data v1.1 (Bagian 7)
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            PersonalizationSeeder::class,
            AddOnSeeder::class,
            BusinessSettingSeeder::class,
        ]);
    }
}

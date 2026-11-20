<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Task ID: DB-024 / DEP-011 — Default Admin Seeder (Nabila Febriyani)
     */
    public function run(): void
    {
        $defaultPassword = env('ADMIN_DEFAULT_PASSWORD', 'BloomeSamarinda2026!');

        Admin::updateOrCreate(
            ['email' => env('ADMIN_DEFAULT_EMAIL', 'admin@bloome.com')],
            [
                'name' => env('BLOOME_OWNER_NAME', 'Nabila Febriyani'),
                'password' => Hash::make($defaultPassword),
            ]
        );
    }
}

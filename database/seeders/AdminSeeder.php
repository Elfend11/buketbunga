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
        Admin::updateOrCreate(
            ['email' => 'admin@bloome.com'],
            [
                'name' => 'Nabila Febriyani',
                'password' => Hash::make('AdminBloome2026!'),
            ]
        );
    }
}


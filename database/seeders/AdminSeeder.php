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
        $email = env('ADMIN_DEFAULT_EMAIL');
        $password = env('ADMIN_DEFAULT_PASSWORD');

        if (!is_string($email) || $email === '' || !is_string($password) || $password === '') {
            throw new \RuntimeException(
                'Admin seeding requires ADMIN_DEFAULT_EMAIL and ADMIN_DEFAULT_PASSWORD environment variables.'
            );
        }

        Admin::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('BLOOME_OWNER_NAME', 'Nabila Febriyani'),
                'password' => Hash::make($password),
            ]
        );
    }
}

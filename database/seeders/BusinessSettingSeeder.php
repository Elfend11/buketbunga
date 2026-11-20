<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessSetting;

class BusinessSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Sesuai Dokumen Spesifikasi Basis Data v1.1 (Bagian 4.10)
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'whatsapp_number',
                'value' => env('BLOOME_WHATSAPP_NUMBER', '6281255554321'),
                'group' => 'contact',
            ],
            [
                'key' => 'shop_address',
                'value' => env('BLOOME_STORE_ADDRESS', 'Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Samarinda'),
                'group' => 'contact',
            ],
            [
                'key' => 'operational_hours',
                'value' => 'Senin - Sabtu: 09.00 - 18.00 WITA, Minggu: Sesuai Konfirmasi',
                'group' => 'general',
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/bloome.samarinda',
                'group' => 'social',
            ],
            [
                'key' => 'store_tagline',
                'value' => 'Flowers & Stories — Curated Floral Artisan in Samarinda',
                'group' => 'general',
            ],
        ];

        foreach ($settings as $setting) {
            BusinessSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}


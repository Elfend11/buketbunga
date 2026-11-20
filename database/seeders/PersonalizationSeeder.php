<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalizationOption;
use App\Models\PersonalizationValue;

class PersonalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Sesuai Dokumen Spesifikasi Basis Data v1.1 (Bagian 4.5, 4.6, 7)
     */
    public function run(): void
    {
        // 1. Opsi Kertas Pembungkus (Wrapping Paper)
        $wrappingOption = PersonalizationOption::updateOrCreate(
            ['name' => 'Warna Kertas Wrapping'],
            [
                'type' => 'color_swatch',
                'is_required' => true,
            ]
        );

        $wrappingValues = [
            ['value_name' => 'Blush Pink', 'color_hex' => '#E99AAF', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Sage Green', 'color_hex' => '#A8B5A0', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Champagne Cream', 'color_hex' => '#F5E6D3', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Classic Black', 'color_hex' => '#2B2B2B', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Pure White', 'color_hex' => '#FFFFFF', 'additional_price' => 0.00, 'is_available' => true],
        ];

        foreach ($wrappingValues as $val) {
            PersonalizationValue::updateOrCreate(
                ['option_id' => $wrappingOption->id, 'value_name' => $val['value_name']],
                $val
            );
        }

        // 2. Opsi Warna Pita Satin
        $ribbonOption = PersonalizationOption::updateOrCreate(
            ['name' => 'Warna Pita Satin'],
            [
                'type' => 'select',
                'is_required' => true,
            ]
        );

        $ribbonValues = [
            ['value_name' => 'Dusty Rose', 'color_hex' => '#DCAE96', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Gold Champagne', 'color_hex' => '#D4AF37', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Olive Satin', 'color_hex' => '#708238', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Deep Navy', 'color_hex' => '#000080', 'additional_price' => 0.00, 'is_available' => true],
            ['value_name' => 'Maroon Velvet', 'color_hex' => '#800000', 'additional_price' => 0.00, 'is_available' => true],
        ];

        foreach ($ribbonValues as $val) {
            PersonalizationValue::updateOrCreate(
                ['option_id' => $ribbonOption->id, 'value_name' => $val['value_name']],
                $val
            );
        }
    }
}


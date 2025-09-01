<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PriceRange;

class PriceRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Global price ranges (without user_store_id for backward compatibility)
        $globalRanges = [
            ['name' => 'Under Rp 10,000', 'min' => 0, 'max' => 10000, 'is_active' => true],
            ['name' => 'Rp 10,000 - Rp 25,000', 'min' => 10000, 'max' => 25000, 'is_active' => true],
            ['name' => 'Rp 25,000 - Rp 50,000', 'min' => 25000, 'max' => 50000, 'is_active' => true],
            ['name' => 'Rp 50,000 - Rp 100,000', 'min' => 50000, 'max' => 100000, 'is_active' => true],
            ['name' => 'Rp 100,000 - Rp 500,000', 'min' => 100000, 'max' => 500000, 'is_active' => true],
            ['name' => 'Rp 500,000 - Rp 1,000,000', 'min' => 500000, 'max' => 1000000, 'is_active' => true],
            ['name' => 'Above Rp 1,000,000', 'min' => 1000000, 'max' => null, 'is_active' => true],
        ];

        foreach ($globalRanges as $range) {
            PriceRange::firstOrCreate(
                ['name' => $range['name']],
                $range
            );
        }
    }
}
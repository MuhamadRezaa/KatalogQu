<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'code' => 'subkategoriproduk',
                'name' => 'Sub Kategori Produk',
            ],
            [
                'code' => 'brandproduk',
                'name' => 'Brand Produk',
            ],
            [
                'code' => 'unitproduk',
                'name' => 'Unit Produk',
            ],
            [
                'code' => 'estimasiwaktu',
                'name' => 'Estimasi Waktu',
            ],
            [
                'code' => 'spesifikasi',
                'name' => 'Spesifikasi',
            ],
            [
                'code' => 'gambartambahan',
                'name' => 'Gambar Tambahan',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate([
                'code' => $menu['code']
            ], $menu);
        }
    }
}

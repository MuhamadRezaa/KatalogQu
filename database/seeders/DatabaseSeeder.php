<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            //PriceRangeSeeder::class,
            // TenantSeeder::class
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@katalogqu.com',
            'password' => Hash::make('@admin123'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);
    }
}
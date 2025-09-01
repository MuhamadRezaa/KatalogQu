<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centralDomain = config('tenancy.central_domains')[0];
        $t1 = Tenant::create(['id' => 'tenant1', 'name' => 'Tenant 1']);
        $t1->domains()->create(['domain' => 'tenant1.' . $centralDomain]);

        $t1 = Tenant::create(['id' => 'tenant2', 'name' => 'Tenant 2']);
        $t1->domains()->create(['domain' => 'tenant2.' . $centralDomain]);

        $t1 = Tenant::create(['id' => 'tenant3', 'name' => 'Tenant 3']);
        $t1->domains()->create(['domain' => 'tenant3.' . $centralDomain]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = [
            'code'      => "A-CS",
            'category'  => "Headquater",
            'name'      => "Alas Coffee & Space",
            'email'     => "alas@gmail.com",
            'phone'     => "14045",
            'address'   => "Bali",
            'npwp_no'    => null
        ];

        Tenant::create($tenant);
    }
}

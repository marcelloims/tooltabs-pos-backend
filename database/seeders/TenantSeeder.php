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
            'code'      => "MyOffice",
            'category'  => "Headquater",
            'name'      => "Tooltabs",
            'email'     => "marcelloimanuel25@gmail.com",
            'phone'     => "081338339626",
            'address'   => "Bali",
            'npwp_no'    => null
        ];

        Tenant::create($tenant);
    }
}

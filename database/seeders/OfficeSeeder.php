<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $office = [
            'tenant_id' => 1,
            'code'      => "A-CS",
            'name'      => "Alas Coffer & Space",
            'email'     => "alas@gmail.com",
            'phone'     => "14045",
            'address'   => "Bali",
            'npwp_no'    => null
        ];

        Office::create($office);
    }
}

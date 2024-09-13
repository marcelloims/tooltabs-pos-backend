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
            'code'      => "TLS",
            'name'      => "Tooltabs",
            'email'     => "marcelloimanuel25@gmail.com",
            'phone'     => "081338339626",
            'address'   => "Bali",
            'npwp_no'    => null
        ];

        Office::create($office);
    }
}

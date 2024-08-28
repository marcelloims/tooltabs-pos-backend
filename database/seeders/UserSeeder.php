<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'department_per_position_id'    => 1,
            'employee_id'                   => 1,
            'nik_no'                        => 20240801,
            'name'                          => "Marcell",
            'email'                         => "marcelloimanuel25@gmail.com",
            'email_verified_at'             => now(),
            'password'                      => bcrypt('password'),
            'activated'                     => 1,
        ];

        User::create($user);
    }
}

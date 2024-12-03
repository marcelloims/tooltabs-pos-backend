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
            'employee_id'                   => 20240801,
            'username'                      => "Marcell",
            'email'                         => "marcelloimanuel25@gmail.com",
            'email_verified_at'             => now(),
            'password'                      => bcrypt('123456'),
            'activated'                     => 1,
        ];

        User::create($user);
    }
}

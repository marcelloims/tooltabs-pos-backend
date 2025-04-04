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
        $users = [
            [
                'department_per_position_id'    => 1,
                'employee_id'                   => 2504001,
                'username'                      => "Boss Alas CS",
                'email'                         => "anggik@gmail.com",
                'email_verified_at'             => now(),
                'password'                      => bcrypt('password'),
                'activated'                     => 1
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

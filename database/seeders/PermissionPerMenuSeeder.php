<?php

namespace Database\Seeders;

use App\Models\PermissionPerMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionPerMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'permission_id' => 1,
            'menu_id'       => 1,
        ];

        PermissionPerMenu::create($data);
    }
}

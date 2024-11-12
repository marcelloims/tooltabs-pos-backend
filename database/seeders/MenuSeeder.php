<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name'          => "Back To Dashboard",
                'submenu'       => "",
                'url'           => "",
                'sequent'       => 100,
                'icon'          => 'flaticon-381-time',
                'created_by'    => 'Seeder',
                'updated_by'    => 'Seeder',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => "Configuration",
                'submenu'       => "",
                'url'           => "",
                'sequent'       => 200,
                'icon'          => 'flaticon-381-stopwatch',
                'created_by'    => 'Seeder',
                'updated_by'    => 'Seeder',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => "Master",
                'submenu'       => "",
                'url'           => "/main/master",
                'sequent'       => 201,
                'icon'          => 'flaticon-381-list-1',
                'created_by'    => 'Seeder',
                'updated_by'    => 'Seeder',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => "Tenant",
                'submenu'       => "",
                'url'           => "/main/tenant",
                'sequent'       => 202,
                'icon'          => '',
                'created_by'    => 'Seeder',
                'updated_by'    => 'Seeder',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => "Office",
                'submenu'       => "",
                'url'           => "/main/office",
                'sequent'       => 203,
                'icon'          => '',
                'created_by'    => 'Seeder',
                'updated_by'    => 'Seeder',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => "Employee",
                'submenu'       => "",
                'url'           => "/main/employee",
                'sequent'       => 204,
                'icon'          => '',
                'created_by'    => 'Seeder',
                'updated_by'    => 'Seeder',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}

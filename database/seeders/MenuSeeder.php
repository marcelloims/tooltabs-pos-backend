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
                "id" => 1,
                "name" => "Back to Main",
                "url" => "",
                "sequent" => "299",
                "expand" => "0",
                "icon" => "flaticon-381-time",
            ],
            [
                "id" => 2,
                "name" => "Go to Configuration",
                "url" => "",
                "sequent" => "199",
                "expand" => "0",
                "icon" => "flaticon-381-settings-2",
            ],
            [
                "id" => 3,
                "name" => "Dashboard",
                "url" => "",
                "sequent" => "101",
                "expand" => "0",
                "icon" => "gauge"
            ],
            [
                "id" => 4,
                "name" => "Tenant",
                "url" => "",
                "sequent" => "202",
                "expand" => "0",
                "icon" => "fa-circle-chevron-right"
            ],
            [
                "id" => 5,
                "name" => "Inventory",
                "url" => "",
                "sequent" => "203",
                "expand" => "0",
                "icon" => "fa-circle-chevron-right"
            ],
            [
                "id" => 6,
                "name" => "Pos",
                "url" => "/main/pos",
                "sequent" => "102",
                "expand" => "0",
                "icon" => "cash-register"
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}

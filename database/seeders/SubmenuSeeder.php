<?php

namespace Database\Seeders;

use App\Models\Submenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submenus = [
            [
                "id" => 1,
                "menu_id" => 4,
                "name" => "Office",
                "url" => "/main/office",
                "sequent" => "201",
                "icon" => "fa-building",
            ],
            [
                "id" => 2,
                "menu_id" => 4,
                "name" => "Department",
                "url" => "/main/department",
                "sequent" => "202",
                "icon" => "fa-landmark",
            ],
            [
                "id" => 3,
                "menu_id" => 4,
                "name" => "Position",
                "url" => "/main/position",
                "sequent" => "203",
                "icon" => "fa-building-user",
            ],
            [
                "id" => 4,
                "menu_id" => 4,
                "name" => "Department Per Position",
                "url" => "/main/department_per_position",
                "sequent" => "204",
                "icon" => "fa-user-tie",
            ],
            [
                "id" => 5,
                "menu_id" => 5,
                "name" => "Category",
                "url" => "/main/category",
                "sequent" => "201",
                "icon" => "fa-vial",
            ],
            [
                "id" => 6,
                "menu_id" => 5,
                "name" => "Type",
                "url" => "/main/type",
                "sequent" => "202",
                "icon" => "fa-vials",
            ],
            [
                "id" => 7,
                "menu_id" => 5,
                "name" => "Product",
                "url" => "/main/product",
                "sequent" => "203",
                "icon" => "fa-vials",
            ],
            [
                "id" => 8,
                "menu_id" => 5,
                "name" => "Product Per Office",
                "url" => "/main/product_per_office",
                "sequent" => "204",
                "icon" => "fa-vials",
            ]
        ];


        foreach ($submenus as $submenu) {
            Submenu::create($submenu);
        }
    }
}

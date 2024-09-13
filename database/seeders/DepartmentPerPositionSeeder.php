<?php

namespace Database\Seeders;

use App\Models\DepartmentPerPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentPerPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentPerPosition = [
            'office_id'     => 1,
            'department_id' => 1,
            'position_id'   => 1,
        ];

        DepartmentPerPosition::create($departmentPerPosition);
    }
}

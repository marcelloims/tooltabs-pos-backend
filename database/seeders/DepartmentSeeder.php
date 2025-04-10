<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = [
            'tenant_id' => 1,
            'office_id' => 1,
            'code'      => "ANG",
            'name'      => "Administration & General",
        ];

        Department::create($department);
    }
}

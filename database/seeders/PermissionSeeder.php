<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'tenant_id' => 1,
            'office_id' => 1,
            'name'      => "Owner",
            'write'     => 1,
            'read'      => 0
        ];

        Permission::create($permission);
    }
}

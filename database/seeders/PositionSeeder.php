<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $position = [
            'tenant_id' => 1,
            'code'      => "Admin",
            'name'      => "Administrator",
        ];

        Position::create($position);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                "level"     => 1,
                "added"     => 1,
                "edited"    => 1,
                "deleted"   => 1,
                "confirmed" => 1,
            ],
            [
                "level"     => 2,
                "added"     => 1,
                "edited"    => 1,
                "deleted"   => 1,
                "confirmed" => 1,
            ],
            [
                "level"     => 3,
                "added"     => 1,
                "edited"    => 1,
                "deleted"   => 1,
                "confirmed" => 0,
            ],
            [
                "level"     => 4,
                "added"     => 1,
                "edited"    => 1,
                "deleted"   => 0,
                "confirmed" => 0,
            ],
        ];

        foreach ($grades as  $grade) {
            Grade::create($grade);
        }
    }
}

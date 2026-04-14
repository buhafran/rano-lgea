<?php

namespace Database\Seeders;

use App\Models\GradingScale;
use Illuminate\Database\Seeder;

class GradingScaleSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['min_score' => 70, 'max_score' => 100, 'grade' => 'A', 'remark' => 'Excellent'],
            ['min_score' => 60, 'max_score' => 69.99, 'grade' => 'B', 'remark' => 'Very Good'],
            ['min_score' => 50, 'max_score' => 59.99, 'grade' => 'C', 'remark' => 'Good'],
            ['min_score' => 45, 'max_score' => 49.99, 'grade' => 'D', 'remark' => 'Fair'],
            ['min_score' => 40, 'max_score' => 44.99, 'grade' => 'E', 'remark' => 'Pass'],
            ['min_score' => 0, 'max_score' => 39.99, 'grade' => 'F', 'remark' => 'Fail'],
        ] as $scale) {
            GradingScale::firstOrCreate(
                ['school_id' => null, 'min_score' => $scale['min_score'], 'max_score' => $scale['max_score']],
                ['grade' => $scale['grade'], 'remark' => $scale['remark']]
            );
        }
    }
}
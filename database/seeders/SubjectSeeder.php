<?php

namespace Database\Seeders;

use App\Models\SchoolLevel;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $primary = SchoolLevel::where('name', 'Primary')->first();

        if (! $primary) {
            return;
        }

        foreach ([
            ['name' => 'English Language', 'code' => 'ENG', 'is_core' => true],
            ['name' => 'Mathematics', 'code' => 'MTH', 'is_core' => true],
            ['name' => 'Basic Science', 'code' => 'BSC', 'is_core' => true],
            ['name' => 'Civic Education', 'code' => 'CVE', 'is_core' => true],
            ['name' => 'Social Studies', 'code' => 'SOS', 'is_core' => true],
            ['name' => 'Hausa Language', 'code' => 'HAU', 'is_core' => false],
            ['name' => 'Physical and Health Education', 'code' => 'PHE', 'is_core' => false],
            ['name' => 'Agricultural Science', 'code' => 'AGR', 'is_core' => false],
        ] as $subject) {
            Subject::firstOrCreate(
                ['name' => $subject['name'], 'school_level_id' => $primary->id],
                ['code' => $subject['code'], 'is_core' => $subject['is_core']]
            );
        }
    }
}

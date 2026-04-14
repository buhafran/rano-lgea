<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\ClassLevel;
use App\Models\SchoolLevel;
use App\Models\SchoolOwnershipType;
use App\Models\TeacherQualification;
use App\Models\Term;
use Illuminate\Database\Seeder;

class AcademicStructureSeeder extends Seeder
{
    public function run(): void
    {
        $primaryLevel = SchoolLevel::firstOrCreate(['name' => 'Primary'], ['code' => 'PRY']);
        SchoolLevel::firstOrCreate(['name' => 'Pre-Primary'], ['code' => 'PPR']);
        SchoolLevel::firstOrCreate(['name' => 'JSS'], ['code' => 'JSS']);
        SchoolLevel::firstOrCreate(['name' => 'SSS'], ['code' => 'SSS']);

        foreach ([
            ['name' => 'First Term', 'code' => 'T1', 'sort_order' => 1],
            ['name' => 'Second Term', 'code' => 'T2', 'sort_order' => 2],
            ['name' => 'Third Term', 'code' => 'T3', 'sort_order' => 3],
        ] as $term) {
            Term::firstOrCreate(['name' => $term['name']], $term);
        }

        foreach ([['name' => 'Public'], ['name' => 'Private']] as $row) {
            SchoolOwnershipType::firstOrCreate(['name' => $row['name']], $row);
        }

        foreach ([
            ['name' => 'Primary 1', 'sort_order' => 1],
            ['name' => 'Primary 2', 'sort_order' => 2],
            ['name' => 'Primary 3', 'sort_order' => 3],
            ['name' => 'Primary 4', 'sort_order' => 4],
            ['name' => 'Primary 5', 'sort_order' => 5],
            ['name' => 'Primary 6', 'sort_order' => 6],
        ] as $classLevel) {
            ClassLevel::firstOrCreate(
                ['name' => $classLevel['name'], 'school_level_id' => $primaryLevel->id],
                ['sort_order' => $classLevel['sort_order']]
            );
        }

        foreach ([
            ['name' => 'NCE', 'is_minimum_required' => true],
            ['name' => 'B.Ed', 'is_minimum_required' => true],
            ['name' => 'B.Sc Ed', 'is_minimum_required' => true],
            ['name' => 'PGDE', 'is_minimum_required' => true],
            ['name' => 'SSCE', 'is_minimum_required' => false],
        ] as $qualification) {
            TeacherQualification::firstOrCreate(['name' => $qualification['name']], $qualification);
        }
    }
}


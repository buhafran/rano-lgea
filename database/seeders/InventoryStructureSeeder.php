<?php

namespace Database\Seeders;

use App\Models\AssetType;
use App\Models\FacilityType;
use Illuminate\Database\Seeder;

class InventoryStructureSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Classroom', 'code' => 'CLASSROOM'],
            ['name' => 'Toilet', 'code' => 'TOILET'],
            ['name' => 'Water Source', 'code' => 'WATER'],
            ['name' => 'Health Facility', 'code' => 'HEALTH'],
            ['name' => 'Blackboard', 'code' => 'BLACKBOARD'],
            ['name' => 'Library', 'code' => 'LIBRARY'],
            ['name' => 'Laboratory', 'code' => 'LAB'],
        ] as $facility) {
            FacilityType::firstOrCreate(['name' => $facility['name']], $facility);
        }

        foreach ([
            ['name' => 'Desk', 'code' => 'DESK'],
            ['name' => 'Chair', 'code' => 'CHAIR'],
            ['name' => 'Computer', 'code' => 'COMPUTER'],
            ['name' => 'Printer', 'code' => 'PRINTER'],
            ['name' => 'Generator', 'code' => 'GENERATOR'],
            ['name' => 'Textbook', 'code' => 'TEXTBOOK'],
            ['name' => 'Sports Equipment', 'code' => 'SPORT'],
        ] as $asset) {
            AssetType::firstOrCreate(['name' => $asset['name']], $asset);
        }
    }
}
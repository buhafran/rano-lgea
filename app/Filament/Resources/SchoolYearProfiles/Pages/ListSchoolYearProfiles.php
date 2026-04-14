<?php

namespace App\Filament\Resources\SchoolYearProfiles\Pages;

use App\Filament\Resources\SchoolYearProfiles\SchoolYearProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchoolYearProfiles extends ListRecords
{
    protected static string $resource = SchoolYearProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\SchoolYearProfiles\Pages;

use App\Filament\Resources\SchoolYearProfiles\SchoolYearProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSchoolYearProfile extends EditRecord
{
    protected static string $resource = SchoolYearProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

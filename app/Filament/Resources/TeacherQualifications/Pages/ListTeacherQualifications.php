<?php

namespace App\Filament\Resources\TeacherQualifications\Pages;

use App\Filament\Resources\TeacherQualifications\TeacherQualificationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTeacherQualifications extends ListRecords
{
    protected static string $resource = TeacherQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

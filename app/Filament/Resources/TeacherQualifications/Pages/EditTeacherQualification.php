<?php

namespace App\Filament\Resources\TeacherQualifications\Pages;

use App\Filament\Resources\TeacherQualifications\TeacherQualificationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTeacherQualification extends EditRecord
{
    protected static string $resource = TeacherQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

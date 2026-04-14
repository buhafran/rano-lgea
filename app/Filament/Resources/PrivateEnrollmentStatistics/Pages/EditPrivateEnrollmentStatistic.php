<?php

namespace App\Filament\Resources\PrivateEnrollmentStatistics\Pages;

use App\Filament\Resources\PrivateEnrollmentStatistics\PrivateEnrollmentStatisticResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPrivateEnrollmentStatistic extends EditRecord
{
    protected static string $resource = PrivateEnrollmentStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

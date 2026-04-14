<?php

namespace App\Filament\Resources\PrivateEnrollmentStatistics\Pages;

use App\Filament\Resources\PrivateEnrollmentStatistics\PrivateEnrollmentStatisticResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrivateEnrollmentStatistics extends ListRecords
{
    protected static string $resource = PrivateEnrollmentStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

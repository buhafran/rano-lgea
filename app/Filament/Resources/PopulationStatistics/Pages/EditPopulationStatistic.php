<?php

namespace App\Filament\Resources\PopulationStatistics\Pages;

use App\Filament\Resources\PopulationStatistics\PopulationStatisticResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPopulationStatistic extends EditRecord
{
    protected static string $resource = PopulationStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

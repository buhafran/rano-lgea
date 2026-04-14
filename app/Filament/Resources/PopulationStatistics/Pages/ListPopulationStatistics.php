<?php

namespace App\Filament\Resources\PopulationStatistics\Pages;

use App\Filament\Resources\PopulationStatistics\PopulationStatisticResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPopulationStatistics extends ListRecords
{
    protected static string $resource = PopulationStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

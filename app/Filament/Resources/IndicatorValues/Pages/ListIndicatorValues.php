<?php

namespace App\Filament\Resources\IndicatorValues\Pages;

use App\Filament\Resources\IndicatorValues\IndicatorValueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIndicatorValues extends ListRecords
{
    protected static string $resource = IndicatorValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\IndicatorValues\Pages;

use App\Filament\Resources\IndicatorValues\IndicatorValueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIndicatorValue extends EditRecord
{
    protected static string $resource = IndicatorValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

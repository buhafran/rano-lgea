<?php

namespace App\Filament\Resources\ResultAccessTokens\Pages;

use App\Filament\Resources\ResultAccessTokens\ResultAccessTokenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResultAccessTokens extends ListRecords
{
    protected static string $resource = ResultAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

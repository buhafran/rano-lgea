<?php

namespace App\Filament\Resources\ResultPublications\Pages;

use App\Filament\Resources\ResultPublications\ResultPublicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResultPublications extends ListRecords
{
    protected static string $resource = ResultPublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

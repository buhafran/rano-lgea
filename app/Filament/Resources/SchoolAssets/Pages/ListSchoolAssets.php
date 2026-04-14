<?php

namespace App\Filament\Resources\SchoolAssets\Pages;

use App\Filament\Resources\SchoolAssets\SchoolAssetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchoolAssets extends ListRecords
{
    protected static string $resource = SchoolAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

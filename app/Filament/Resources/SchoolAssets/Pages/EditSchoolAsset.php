<?php

namespace App\Filament\Resources\SchoolAssets\Pages;

use App\Filament\Resources\SchoolAssets\SchoolAssetResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSchoolAsset extends EditRecord
{
    protected static string $resource = SchoolAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

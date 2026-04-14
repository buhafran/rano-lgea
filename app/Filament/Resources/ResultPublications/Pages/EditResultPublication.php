<?php

namespace App\Filament\Resources\ResultPublications\Pages;

use App\Filament\Resources\ResultPublications\ResultPublicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResultPublication extends EditRecord
{
    protected static string $resource = ResultPublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

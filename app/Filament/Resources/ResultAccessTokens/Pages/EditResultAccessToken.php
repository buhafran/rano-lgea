<?php

namespace App\Filament\Resources\ResultAccessTokens\Pages;

use App\Filament\Resources\ResultAccessTokens\ResultAccessTokenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResultAccessToken extends EditRecord
{
    protected static string $resource = ResultAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

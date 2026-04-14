<?php

namespace App\Filament\Resources\ResultAccessTokens;

use App\Filament\Resources\ResultAccessTokens\Pages\CreateResultAccessToken;
use App\Filament\Resources\ResultAccessTokens\Pages\EditResultAccessToken;
use App\Filament\Resources\ResultAccessTokens\Pages\ListResultAccessTokens;
use App\Filament\Resources\ResultAccessTokens\Schemas\ResultAccessTokenForm;
use App\Filament\Resources\ResultAccessTokens\Tables\ResultAccessTokensTable;
use App\Models\ResultAccessToken;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResultAccessTokenResource extends Resource
{
    protected static ?string $model = ResultAccessToken::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ResultAccessTokenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResultAccessTokensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResultAccessTokens::route('/'),
            'create' => CreateResultAccessToken::route('/create'),
            'edit' => EditResultAccessToken::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\ResultPublications;

use App\Filament\Resources\ResultPublications\Pages\CreateResultPublication;
use App\Filament\Resources\ResultPublications\Pages\EditResultPublication;
use App\Filament\Resources\ResultPublications\Pages\ListResultPublications;
use App\Filament\Resources\ResultPublications\Schemas\ResultPublicationForm;
use App\Filament\Resources\ResultPublications\Tables\ResultPublicationsTable;
use App\Models\ResultPublication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResultPublicationResource extends Resource
{
    protected static ?string $model = ResultPublication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ResultPublicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {

        return ResultPublicationsTable::configure($table);
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
            'index' => ListResultPublications::route('/'),
            'create' => CreateResultPublication::route('/create'),
            'edit' => EditResultPublication::route('/{record}/edit'),
        ];
    }
}

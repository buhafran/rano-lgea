<?php

namespace App\Filament\Resources\AcademicSessions;


use App\Filament\Resources\AcademicSessions\Pages\CreateAcademicSession;
use App\Filament\Resources\AcademicSessions\Pages\EditAcademicSession;
use App\Filament\Resources\AcademicSessions\Pages\ListAcademicSessions;
use App\Filament\Resources\AcademicSessions\Schemas\AcademicSessionForm;
use App\Filament\Resources\AcademicSessions\Tables\AcademicSessionsTable;
use App\Models\AcademicSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class AcademicSessionResource extends Resource
{
    protected static ?string $model = AcademicSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        
        return AcademicSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicSessionsTable::configure($table);
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
            'index' => ListAcademicSessions::route('/'),
            'create' => CreateAcademicSession::route('/create'),
            'edit' => EditAcademicSession::route('/{record}/edit'),
        ];
    }
}

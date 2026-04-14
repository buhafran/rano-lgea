<?php

namespace App\Filament\Resources\ClassLevels;

use App\Filament\Resources\ClassLevels\Pages;
use App\Models\ClassLevel;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ClassLevelResource extends Resource
{
    protected static ?string $model = ClassLevel::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-queue-list';
    protected static string|\UnitEnum|null $navigationGroup = 'Academics & Results';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Class Level')
                ->schema([
                    Select::make('school_level_id')->relationship('schoolLevel', 'name')->searchable()->preload(),
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('sort_order')->numeric()->default(0)->required(),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('schoolLevel.name')->label('School Level')->sortable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('schoolLevel')->relationship('schoolLevel', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassLevels::route('/'),
            'create' => Pages\CreateClassLevel::route('/create'),
            'edit' => Pages\EditClassLevel::route('/{record}/edit'),
        ];
    }
}

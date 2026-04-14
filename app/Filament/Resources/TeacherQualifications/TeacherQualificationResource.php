<?php

namespace App\Filament\Resources\TeacherQualifications;

use App\Filament\Resources\TeacherQualifications\Pages;
use App\Models\TeacherQualification;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TeacherQualificationResource extends Resource
{
    protected static ?string $model = TeacherQualification::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';
    protected static string|\UnitEnum|null $navigationGroup = 'Teachers & Staff';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Qualification')
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    Toggle::make('is_minimum_required')->default(false),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_minimum_required')->boolean(),
                Tables\Columns\TextColumn::make('teachers_count')->counts('teachers')->label('Teachers'),
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
            'index' => Pages\ListTeacherQualifications::route('/'),
            'create' => Pages\CreateTeacherQualification::route('/create'),
            'edit' => Pages\EditTeacherQualification::route('/{record}/edit'),
        ];
    }
}

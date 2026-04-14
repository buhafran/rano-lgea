<?php

namespace App\Filament\Resources\Subjects;

use App\Filament\Resources\Subjects\Pages;
use App\Models\Subject;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-book-open';
    protected static string|\UnitEnum|null $navigationGroup = 'Academics & Results';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Subject')
                ->schema([
                    Select::make('school_level_id')->relationship('schoolLevel', 'name')->searchable()->preload(),
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('code')->maxLength(50),
                    Toggle::make('is_core')->default(false),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('schoolLevel.name')->label('School Level')->sortable(),
                Tables\Columns\IconColumn::make('is_core')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('schoolLevel')->relationship('schoolLevel', 'name'),
                Tables\Filters\TernaryFilter::make('is_core'),
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}

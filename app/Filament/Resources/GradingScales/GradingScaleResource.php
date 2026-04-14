<?php

namespace App\Filament\Resources\GradingScales;

use App\Filament\Resources\GradingScales\Pages;
use App\Models\GradingScale;
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

class GradingScaleResource extends Resource
{
    protected static ?string $model = GradingScale::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar-square';
    protected static string|\UnitEnum|null $navigationGroup = 'Academics & Results';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Grade Band')
                ->schema([
                    Select::make('school_id')
                        ->relationship('school', 'name')
                        ->searchable()
                        ->preload()
                        ->helperText('Leave empty for the global default grading scale.'),
                    TextInput::make('min_score')->numeric()->required(),
                    TextInput::make('max_score')->numeric()->required(),
                    TextInput::make('grade')->required()->maxLength(10),
                    TextInput::make('remark')->required()->maxLength(100),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')->label('School')->placeholder('Global Default')->wrap(),
                Tables\Columns\TextColumn::make('min_score')->numeric(decimalPlaces: 2)->sortable(),
                Tables\Columns\TextColumn::make('max_score')->numeric(decimalPlaces: 2)->sortable(),
                Tables\Columns\TextColumn::make('grade')->badge(),
                Tables\Columns\TextColumn::make('remark')->searchable(),
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
            'index' => Pages\ListGradingScales::route('/'),
            'create' => Pages\CreateGradingScale::route('/create'),
            'edit' => Pages\EditGradingScale::route('/{record}/edit'),
        ];
    }
}

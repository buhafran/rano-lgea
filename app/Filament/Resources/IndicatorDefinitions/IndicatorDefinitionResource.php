<?php

namespace App\Filament\Resources\IndicatorDefinitions;

use App\Filament\Resources\IndicatorDefinitions\Pages;
use App\Models\IndicatorDefinition;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class IndicatorDefinitionResource extends Resource
{

    protected static ?string $model = IndicatorDefinition::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calculator';
    protected static string|\UnitEnum|null $navigationGroup = 'Indicators & Census';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Indicator')->schema([
                TextInput::make('code')->required()->maxLength(50)->unique(ignoreRecord: true),
                TextInput::make('name')->required()->maxLength(255),
                Select::make('level')->options([
                    'school' => 'School',
                    'lga' => 'LGA',
                    'state' => 'State',
                ])->required()->default('lga'),
                Select::make('data_type')->options([
                    'integer' => 'Integer',
                    'decimal' => 'Decimal',
                    'percentage' => 'Percentage',
                    'ratio' => 'Ratio',
                ])->required()->default('decimal'),
                Toggle::make('is_calculated')->default(true),
                Textarea::make('description')->columnSpanFull(),
                Textarea::make('formula')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->searchable()->sortable()->badge(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('level')->badge(),
                Tables\Columns\TextColumn::make('data_type')->badge(),
                Tables\Columns\IconColumn::make('is_calculated')->boolean(),
                Tables\Columns\TextColumn::make('values_count')->counts('values')->label('Values'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('level')->options([
                    'school' => 'School',
                    'lga' => 'LGA',
                    'state' => 'State',
                ]),
                Tables\Filters\SelectFilter::make('data_type')->options([
                    'integer' => 'Integer',
                    'decimal' => 'Decimal',
                    'percentage' => 'Percentage',
                    'ratio' => 'Ratio',
                ]),
                Tables\Filters\TernaryFilter::make('is_calculated'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndicatorDefinitions::route('/'),
            'create' => Pages\CreateIndicatorDefinition::route('/create'),
            'edit' => Pages\EditIndicatorDefinition::route('/{record}/edit'),
        ];
    }
}
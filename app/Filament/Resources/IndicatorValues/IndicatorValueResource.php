<?php

namespace App\Filament\Resources\IndicatorValues;

use App\Filament\Resources\IndicatorValues\Pages;
use App\Models\IndicatorValue;
use Filament\Actions\BulkActionGroup;      
use Filament\Actions\DeleteBulkAction;     
use Filament\Actions\EditAction;          
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;  
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class IndicatorValueResource extends Resource
{


    protected static ?string $model = IndicatorValue::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static string|\UnitEnum|null $navigationGroup = 'Indicators & Census';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Indicator Value')->schema([
                Select::make('indicator_definition_id')->relationship('indicatorDefinition', 'name')->searchable()->preload()->required(),
                Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload()->required(),
                Select::make('term_id')->relationship('term', 'name')->searchable()->preload(),
                Select::make('school_id')->relationship('school', 'name')->searchable()->preload(),
                Select::make('ward_id')->relationship('ward', 'name')->searchable()->preload(),
                TextInput::make('lga_name')->maxLength(255)->default('RANO'),
                TextInput::make('male_value')->numeric(),
                TextInput::make('female_value')->numeric(),
                TextInput::make('total_value')->numeric(),
                Select::make('source')->options([
                    'computed' => 'Computed',
                    'imported' => 'Imported',
                    'manual' => 'Manual',
                ])->required()->default('computed'),
                Textarea::make('notes')->columnSpanFull(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('indicatorDefinition.code')->label('Code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('indicatorDefinition.name')->label('Indicator')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->sortable(),
                Tables\Columns\TextColumn::make('term.name')->label('Term')->placeholder('-'),
                Tables\Columns\TextColumn::make('school.name')->label('School')->placeholder('-')->wrap(),
                Tables\Columns\TextColumn::make('ward.name')->label('Ward')->placeholder('-'),
                Tables\Columns\TextColumn::make('male_value')->numeric(decimalPlaces: 2),
                Tables\Columns\TextColumn::make('female_value')->numeric(decimalPlaces: 2),
                Tables\Columns\TextColumn::make('total_value')->numeric(decimalPlaces: 2),
                Tables\Columns\TextColumn::make('source')->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('indicatorDefinition')->relationship('indicatorDefinition', 'name'),
                Tables\Filters\SelectFilter::make('academicSession')->relationship('academicSession', 'name'),
                Tables\Filters\SelectFilter::make('term')->relationship('term', 'name'),
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('ward')->relationship('ward', 'name'),
                Tables\Filters\SelectFilter::make('source')->options([
                    'computed' => 'Computed',
                    'imported' => 'Imported',
                    'manual' => 'Manual',
                ]),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndicatorValues::route('/'),
            'create' => Pages\CreateIndicatorValue::route('/create'),
            'edit' => Pages\EditIndicatorValue::route('/{record}/edit'),
        ];
    }
}
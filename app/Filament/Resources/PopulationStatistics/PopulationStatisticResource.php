<?php

namespace App\Filament\Resources\PopulationStatistics;

use App\Filament\Resources\PopulationStatistics\Pages;
use App\Models\PopulationStatistic;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;      
use Filament\Actions\DeleteBulkAction;     
use Filament\Actions\EditAction;          
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;  

use Filament\Tables;
use Filament\Tables\Table;

class PopulationStatisticResource extends Resource
{

    protected static ?string $model = PopulationStatistic::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static string|\UnitEnum|null $navigationGroup = 'Indicators & Census';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Population Statistic')->schema([
                Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload(),
                Select::make('ward_id')->relationship('ward', 'name')->searchable()->preload(),
                TextInput::make('lga_name')->maxLength(255)->default('RANO'),
                TextInput::make('age')->numeric()->minValue(0)->maxValue(120),
                Select::make('gender')->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'total' => 'Total',
                ])->required()->default('total'),
                TextInput::make('population')->numeric()->default(0)->required(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->placeholder('-')->sortable(),
                Tables\Columns\TextColumn::make('ward.name')->label('Ward')->placeholder('-'),
                Tables\Columns\TextColumn::make('lga_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('age')->sortable()->placeholder('-'),
                Tables\Columns\TextColumn::make('gender')->badge(),
                Tables\Columns\TextColumn::make('population')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('academicSession')->relationship('academicSession', 'name'),
                Tables\Filters\SelectFilter::make('ward')->relationship('ward', 'name'),
                Tables\Filters\SelectFilter::make('gender')->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'total' => 'Total',
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
            'index' => Pages\ListPopulationStatistics::route('/'),
            'create' => Pages\CreatePopulationStatistic::route('/create'),
            'edit' => Pages\EditPopulationStatistic::route('/{record}/edit'),
        ];
    }
}
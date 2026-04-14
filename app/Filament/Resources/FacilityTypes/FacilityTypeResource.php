<?php

namespace App\Filament\Resources\FacilityTypes;

use App\Filament\Resources\FacilityTypes\Pages;
use App\Models\FacilityType;
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

class FacilityTypeResource extends Resource
{
    protected static ?string $model = FacilityType::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home-modern';
    protected static string|\UnitEnum|null $navigationGroup = 'Facilities & Assets';


    public static function form(Schema $schema): Schema
    {
        return $schema->components([  // Change from 'schema' to 'components'
            Section::make('Facility Type')
                ->schema([            // This stays as 'schema' (inside Section)
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('code')
                        ->maxLength(100)
                        ->unique(ignoreRecord: true),
                    Textarea::make('description')
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('school_facilities_count')
                    ->counts('schoolFacilities')
                    ->label('Entries'),
            ])
            ->recordActions([              // Change from 'actions' to 'recordActions'
                EditAction::make(),
            ])
            ->toolbarActions([             // Change from 'bulkActions' to 'toolbarActions'
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacilityTypes::route('/'),
            'create' => Pages\CreateFacilityType::route('/create'),
            'edit' => Pages\EditFacilityType::route('/{record}/edit'),
        ];
    }

}
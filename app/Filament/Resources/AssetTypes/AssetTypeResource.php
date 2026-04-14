<?php

// namespace App\Filament\Resources;
namespace App\Filament\Resources\AssetTypes;


use App\Filament\Resources\AssetTypes\Pages;
use App\Models\AssetType;
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



class AssetTypeResource extends Resource
{
    protected static ?string $model = AssetType::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';
    protected static string|\UnitEnum|null $navigationGroup = 'Facilities & Assets';


    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Asset Type')->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('code')->maxLength(100)->unique(ignoreRecord: true),
                Textarea::make('description')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('school_assets_count')->counts('schoolAssets')->label('Entries'),
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
            'index' => Pages\ListAssetTypes::route('/'),
            'create' => Pages\CreateAssetType::route('/create'),
            'edit' => Pages\EditAssetType::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolAssetResource\Pages;
use App\Models\SchoolAsset;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class SchoolAssetResource extends Resource
{
    protected static ?string $model = SchoolAsset::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string|\UnitEnum|null $navigationGroup ='Facilities & Assets';



    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Section::make('Asset Record')->schema([
                Forms\Components\Select::make('school_id')->relationship('school', 'name')->searchable()->preload()->required(),
                Forms\Components\Select::make('asset_type_id')->relationship('assetType', 'name')->searchable()->preload()->required(),
                Forms\Components\Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload(),
                Forms\Components\TextInput::make('quantity')->numeric()->default(0)->required(),
                Forms\Components\TextInput::make('functional_quantity')->numeric()->default(0)->required(),
                Forms\Components\Select::make('condition')->options([
                    'good' => 'Good',
                    'fair' => 'Fair',
                    'poor' => 'Poor',
                ]),
                Forms\Components\Textarea::make('notes')->columnSpanFull(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')->label('School')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('assetType.name')->label('Asset Type')->sortable(),
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->sortable(),
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\TextColumn::make('functional_quantity')->sortable(),
                Tables\Columns\TextColumn::make('condition')->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('assetType')->relationship('assetType', 'name'),
                Tables\Filters\SelectFilter::make('academicSession')->relationship('academicSession', 'name'),
                Tables\Filters\SelectFilter::make('condition')->options([
                    'good' => 'Good',
                    'fair' => 'Fair',
                    'poor' => 'Poor',
                ]),
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
            'index' => Pages\ListSchoolAssets::route('/'),
            'create' => Pages\CreateSchoolAsset::route('/create'),
            'edit' => Pages\EditSchoolAsset::route('/{record}/edit'),
        ];
    }
}
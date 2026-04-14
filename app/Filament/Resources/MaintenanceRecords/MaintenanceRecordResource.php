<?php

namespace App\Filament\Resources\MaintenanceRecords;

use App\Filament\Resources\MaintenanceRecords\Pages;
use App\Models\MaintenanceRecord;
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

class MaintenanceRecordResource extends Resource
{
    protected static ?string $model = MaintenanceRecord::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static string|\UnitEnum|null $navigationGroup = 'Facilities & Assets';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Maintenance Request')->schema([
                Select::make('school_id')->relationship('school', 'name')->searchable()->preload()->required(),
                Select::make('facility_type_id')->relationship('facilityType', 'name')->searchable()->preload(),
                Select::make('asset_type_id')->relationship('assetType', 'name')->searchable()->preload(),
                TextInput::make('title')->required()->maxLength(255),
                Select::make('status')->options([
                    'pending' => 'Pending',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                ])->default('pending')->required(),
                DatePicker::make('reported_date'),
                DatePicker::make('resolved_date'),
                TextInput::make('estimated_cost')->numeric()->prefix('₦'),
                Textarea::make('description')->columnSpanFull(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')->label('School')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('facilityType.name')->label('Facility')->placeholder('-'),
                Tables\Columns\TextColumn::make('assetType.name')->label('Asset')->placeholder('-'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('estimated_cost')->money('NGN'),
                Tables\Columns\TextColumn::make('reported_date')->date(),
                Tables\Columns\TextColumn::make('resolved_date')->date()->placeholder('-'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('facilityType')->relationship('facilityType', 'name'),
                Tables\Filters\SelectFilter::make('assetType')->relationship('assetType', 'name'),
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
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
            'index' => Pages\ListMaintenanceRecords::route('/'),
            'create' => Pages\CreateMaintenanceRecord::route('/create'),
            'edit' => Pages\EditMaintenanceRecord::route('/{record}/edit'),
        ];
    }
}
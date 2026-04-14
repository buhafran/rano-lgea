<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolFacilityResource\Pages;
use App\Models\SchoolFacility;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Select;
use Filament\TextInput;
use Filament\Textarea;
use Filament\Toggle;

class SchoolFacilityResource extends Resource
{
   
    protected static ?string $model = SchoolFacility::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office';
    protected static string|\UnitEnum|null $navigationGroup =  'Facilities & Assets';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Facility Record')->schema([
                Select::make('school_id')->relationship('school', 'name')->searchable()->preload()->required(),
                Select::make('facility_type_id')->relationship('facilityType', 'name')->searchable()->preload()->required(),
                Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload(),
                TextInput::make('quantity')->numeric()->default(0)->required(),
                TextInput::make('usable_quantity')->numeric()->default(0)->required(),
                Select::make('condition')->options([
                    'good' => 'Good',
                    'fair' => 'Fair',
                    'poor' => 'Poor',
                ]),
                Textarea::make('notes')->columnSpanFull(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')->label('School')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('facilityType.name')->label('Facility Type')->sortable(),
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->sortable(),
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\TextColumn::make('usable_quantity')->sortable(),
                Tables\Columns\TextColumn::make('condition')->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('facilityType')->relationship('facilityType', 'name'),
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
            'index' => Pages\ListSchoolFacilities::route('/'),
            'create' => Pages\CreateSchoolFacility::route('/create'),
            'edit' => Pages\EditSchoolFacility::route('/{record}/edit'),
        ];
    }
}
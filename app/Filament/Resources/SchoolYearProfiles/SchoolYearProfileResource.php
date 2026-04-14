<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolYearProfileResource\Pages;
use App\Models\SchoolYearProfile;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class SchoolYearProfileResource extends Resource
{

    protected static ?string $model = SchoolYearProfile::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-pie';
    protected static string|\UnitEnum|null $navigationGroup ='Facilities & Assets';

    public static function form(Schema $schema): Schema
    {
     


        return $schema->schema([
            Section::make('Context')->schema([
                Select::make('school_id')->relationship('school', 'name')->searchable()->preload()->required(),
                Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload()->required(),
            ])->columns(2),

            Section::make('Enrollment Summary')->schema([
                TextInput::make('pre_primary_enrollment_male')->numeric()->default(0)->required(),
                TextInput::make('pre_primary_enrollment_female')->numeric()->default(0)->required(),
                TextInput::make('primary_enrollment_male')->numeric()->default(0)->required(),
                TextInput::make('primary_enrollment_female')->numeric()->default(0)->required(),
            ])->columns(4),

            Section::make('Teacher Summary')->schema([
                TextInput::make('total_teachers_male')->numeric()->default(0)->required(),
                TextInput::make('total_teachers_female')->numeric()->default(0)->required(),
                TextInput::make('qualified_teachers')->numeric()->default(0)->required(),
                TextInput::make('female_teachers')->numeric()->default(0)->required(),
            ])->columns(4),

            Section::make('Infrastructure Summary')->schema([
                TextInput::make('usable_classrooms')->numeric()->default(0)->required(),
                TextInput::make('total_classrooms')->numeric()->default(0)->required(),
                TextInput::make('pupils_per_classroom')->numeric(),
                TextInput::make('pupil_toilet_ratio')->numeric(),
                Toggle::make('has_water_source'),
                Toggle::make('has_health_facility'),
                TextInput::make('blackboards_in_good_condition')->numeric()->default(0)->required(),
                TextInput::make('total_blackboards')->numeric()->default(0)->required(),
            ])->columns(4),

            Section::make('Remarks')->schema([
                Textarea::make('remarks')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school.name')->label('School')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->sortable(),
                Tables\Columns\TextColumn::make('primary_total')->label('Primary Enrolment'),
                Tables\Columns\TextColumn::make('total_teachers')->label('Teachers'),
                Tables\Columns\TextColumn::make('usable_classrooms')->sortable(),
                Tables\Columns\IconColumn::make('has_water_source')->boolean(),
                Tables\Columns\IconColumn::make('has_health_facility')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('academicSession')->relationship('academicSession', 'name'),
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
            'index' => Pages\ListSchoolYearProfiles::route('/'),
            'create' => Pages\CreateSchoolYearProfile::route('/create'),
            'edit' => Pages\EditSchoolYearProfile::route('/{record}/edit'),
        ];
    }
}
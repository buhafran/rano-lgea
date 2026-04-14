<?php

namespace App\Filament\Resources\PrivateEnrollmentStatistics;

use App\Filament\Resources\PrivateEnrollmentStatistics\Pages;
use App\Models\PrivateEnrollmentStatistic;
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

class PrivateEnrollmentStatisticResource extends Resource
{


    protected static ?string $model = PrivateEnrollmentStatistic::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-library';
    protected static string|\UnitEnum|null $navigationGroup = 'Indicators & Census';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Private Enrolment')->schema([
                Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload()->required(),
                TextInput::make('lga_name')->required()->maxLength(255)->default('RANO'),
                TextInput::make('level')->required()->maxLength(255),
                TextInput::make('male')->numeric()->default(0)->required(),
                TextInput::make('female')->numeric()->default(0)->required(),
                TextInput::make('total')->numeric()->default(0)->required(),
                TextInput::make('source_document')->maxLength(255),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->sortable(),
                Tables\Columns\TextColumn::make('lga_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('level')->searchable()->sortable()->badge(),
                Tables\Columns\TextColumn::make('male')->sortable(),
                Tables\Columns\TextColumn::make('female')->sortable(),
                Tables\Columns\TextColumn::make('total')->sortable(),
                Tables\Columns\TextColumn::make('source_document')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('academicSession')->relationship('academicSession', 'name'),
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
            'index' => Pages\ListPrivateEnrollmentStatistics::route('/'),
            'create' => Pages\CreatePrivateEnrollmentStatistic::route('/create'),
            'edit' => Pages\EditPrivateEnrollmentStatistic::route('/{record}/edit'),
        ];
    }
}
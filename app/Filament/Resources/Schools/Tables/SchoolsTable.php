<?php

namespace App\Filament\Resources\Schools\Tables;

use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SchoolsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->wrap(),
                TextColumn::make('ward.name')->label('Ward')->sortable()->searchable(),
                TextColumn::make('schoolLevel.name')->label('Level')->sortable(),
                TextColumn::make('ownershipType.name')->label('Ownership')->sortable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('teachers_count')->counts('teachers')->label('Teachers'),
                TextColumn::make('students_count')->counts('students')->label('Students'),
            ])
            ->filters([
                SelectFilter::make('ward')->relationship('ward', 'name'),
                SelectFilter::make('schoolLevel')->relationship('schoolLevel', 'name'),
                SelectFilter::make('ownershipType')->relationship('ownershipType', 'name'),
                TernaryFilter::make('is_active'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
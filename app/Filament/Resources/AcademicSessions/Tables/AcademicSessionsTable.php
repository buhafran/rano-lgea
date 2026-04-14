<?php

namespace App\Filament\Resources\AcademicSessions\Tables;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;


class AcademicSessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('start_date')->date()->sortable(),
                TextColumn::make('end_date')->date()->sortable(),
                IconColumn::make('is_current')->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_current'),
            ])
            ->actions([
                // EditAction::make(),
            ])
            ->bulkActions([
                // DeleteBulkAction::make(),
            ]);
    }
}
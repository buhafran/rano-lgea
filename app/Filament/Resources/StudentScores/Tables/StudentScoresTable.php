<?php

namespace App\Filament\Resources\StudentScores\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class StudentScoresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.full_name'),
                TextColumn::make('school.name'),
                TextColumn::make('academicSession.name'),
                TextColumn::make('term.name'),
                TextColumn::make('classLevel.name'),
                TextColumn::make('subject.name'),
                TextColumn::make('total_score'),
                TextColumn::make('grade')->badge(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\ResultPublications\Tables;

use App\Filament\Tables\BaseTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action; // Add this import
use Filament\Notifications\Notification; // Optional: for notifications

class ResultPublicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('academic_session.name')
                    ->searchable(),
                TextColumn::make('term.name')
                    ->searchable(),
                TextColumn::make('class_level.name')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        default => 'primary',
                    }),
                // Add other columns as needed
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                
                // Insert your publish action here
                Action::make('publish')
                    ->label('Publish')
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->action(function ($record) {
                        app(\App\Services\ResultPublishingService::class)->publish(
                            schoolId: $record->school_id,
                            academicSessionId: $record->academic_session_id,
                            termId: $record->term_id,
                            classLevelId: $record->class_level_id,
                            notes: 'Published from admin panel'
                        );
                        
                        // Optional: Show success notification
                        Notification::make()
                            ->success()
                            ->title('Published successfully')
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status !== 'published'), // Only show if not already published
            ])
            ->bulkActions([
                // Optional: Add bulk publish action
                Action::make('bulk_publish')
                    ->label('Publish Selected')
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->action(function ($records) {
                        foreach ($records as $record) {
                            app(\App\Services\ResultPublishingService::class)->publish(
                                schoolId: $record->school_id,
                                academicSessionId: $record->academic_session_id,
                                termId: $record->term_id,
                                classLevelId: $record->class_level_id,
                                notes: 'Bulk published from admin panel'
                            );
                        }
                        
                        Notification::make()
                            ->success()
                            ->title(count($records) . ' records published successfully')
                            ->send();
                    }),
            ]);
    }
}
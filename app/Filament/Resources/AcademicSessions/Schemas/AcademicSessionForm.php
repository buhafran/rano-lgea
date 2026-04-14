<?php

namespace App\Filament\Resources\AcademicSessions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;


class AcademicSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Session')
                ->schema([
                    TextInput::make('name')->required()->maxLength(20)->placeholder('2025/2026'),
                    DatePicker::make('start_date')->required(),
                    DatePicker::make('end_date')->required()->after('start_date'),
                    Toggle::make('is_current')->default(false),
                ])
                ->columns(2),
        ]);
    }
}
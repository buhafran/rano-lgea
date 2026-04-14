<?php

namespace App\Filament\Resources\TeacherQualifications\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherQualificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Qualification')
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    Toggle::make('is_minimum_required')->default(false),
                ])
                ->columns(2),
        ]);
    }
}
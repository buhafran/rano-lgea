<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Subject')
                ->schema([
                    Select::make('school_level_id')->relationship('schoolLevel', 'name')->searchable()->preload(),
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('code')->maxLength(50),
                    Toggle::make('is_core')->default(false),
                ])
                ->columns(2),
        ]);
    }
}
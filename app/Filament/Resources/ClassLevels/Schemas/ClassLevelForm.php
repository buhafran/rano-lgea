<?php

namespace App\Filament\Resources\ClassLevels\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClassLevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Class Level')
                    ->schema([
                        Select::make('school_level_id')->relationship('schoolLevel', 'name'),
                        TextInput::make('name')->required(),
                        TextInput::make('sort_order')->numeric()->default(0),
                    ])->columns(3),
            ]);
    }
}

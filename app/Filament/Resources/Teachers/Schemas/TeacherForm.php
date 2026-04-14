<?php

namespace App\Filament\Resources\Teachers\Schemas;


use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Biodata')
    ->schema([
        Select::make('school_id')->relationship('school', 'name'),
        Select::make('qualification_id')->relationship('qualification', 'name'),
        TextInput::make('staff_no')->unique(ignoreRecord: true),
        TextInput::make('surname')->required(),
        TextInput::make('first_name')->required(),
        TextInput::make('other_names'),
        Select::make('gender')->options(['male'=>'Male','female'=>'Female']),
        Toggle::make('is_qualified')->default(false),
    ])->columns(3),
            ]);
    }
}

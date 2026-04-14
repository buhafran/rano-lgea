<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
    ->schema([
        Select::make('school_id')->relationship('school', 'name'),
        TextInput::make('admission_no')->unique(ignoreRecord: true),
        TextInput::make('surname')->required(),
        TextInput::make('first_name')->required(),
        TextInput::make('other_names'),
        Select::make('gender')->options(['male'=>'Male','female'=>'Female']),
        DatePicker::make('date_of_birth'),
        TextInput::make('entry_age')->numeric(),
        Toggle::make('is_active')->default(true),
    ])->columns(3),
            ]);
    }
}

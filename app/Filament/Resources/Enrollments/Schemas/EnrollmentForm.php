<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Enrollment')
    ->schema([
        Select::make('student_id')->relationship('student','surname'),
        Select::make('school_id')->relationship('school','name'),
        Select::make('academic_session_id')->relationship('academicSession','name'),
        Select::make('term_id')->relationship('term','name'),
        Select::make('class_level_id')->relationship('classLevel','name'),
        Toggle::make('is_new_intake'),
        TextInput::make('entry_age')->numeric(),
        Select::make('enrollment_status')->options([
            'active'=>'Active','graduated'=>'Graduated'
        ]),
    ])->columns(2),
            ]);
    }
}

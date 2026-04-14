<?php

namespace App\Filament\Resources\StudentScores\Schemas;


use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StudentScoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Score Entry')
    ->schema([
        Select::make('student_id')->relationship('student','surname'),
        Select::make('school_id')->relationship('school','name'),
        Select::make('academic_session_id')->relationship('academicSession','name'),
        Select::make('term_id')->relationship('term','name'),
        Select::make('class_level_id')->relationship('classLevel','name'),
        Select::make('subject_id')->relationship('subject','name'),
        TextInput::make('ca_score')->numeric(),
        TextInput::make('exam_score')->numeric(),
        TextInput::make('total_score')->disabled(),
        TextInput::make('grade')->disabled(),
        TextInput::make('remark')->disabled(),
    ])->columns(3),
            ]);
    }
}

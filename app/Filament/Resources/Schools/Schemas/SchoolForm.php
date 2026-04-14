<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Basic Information')
                ->schema([
                    Select::make('ward_id')->relationship('ward', 'name')->searchable()->preload()->required(),
                    Select::make('ownership_type_id')->relationship('ownershipType', 'name')->searchable()->preload(),
                    Select::make('school_level_id')->relationship('schoolLevel', 'name')->searchable()->preload(),
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('code')->maxLength(50)->unique(ignoreRecord: true),
                    TextInput::make('emis_code')->maxLength(50)->unique(ignoreRecord: true),
                    TextInput::make('established_year')->numeric()->minValue(1900)->maxValue((int) date('Y')),
                    Toggle::make('is_active')->default(true),
                ])
                ->columns(3),

            Section::make('Contact & Location')
                ->schema([
                    TextInput::make('head_teacher_name')->maxLength(255),
                    TextInput::make('phone')->tel()->maxLength(30),
                    TextInput::make('email')->email()->maxLength(255),
                    Textarea::make('address')->columnSpanFull(),
                    TextInput::make('latitude')->numeric(),
                    TextInput::make('longitude')->numeric(),
                ])
                ->columns(2),
        ]);
    }
}
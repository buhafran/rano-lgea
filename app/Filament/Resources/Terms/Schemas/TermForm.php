<?php

namespace App\Filament\Resources\Terms\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TermForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Term')
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('code')->maxLength(20)->unique(ignoreRecord: true),
                    TextInput::make('sort_order')->numeric()->default(0)->required(),
                ])
                ->columns(3),
        ]);
    }
}
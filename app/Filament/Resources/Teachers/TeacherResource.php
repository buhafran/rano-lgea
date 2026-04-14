<?php

namespace App\Filament\Resources\Teachers;

use App\Filament\Resources\Teachers\Pages;
use App\Models\Teacher;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static string|\UnitEnum|null $navigationGroup = 'Teachers & Staff';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Biodata')
                ->schema([
                    Select::make('school_id')->relationship('school', 'name')->searchable()->preload(),
                    Select::make('qualification_id')->relationship('qualification', 'name')->searchable()->preload(),
                    TextInput::make('staff_no')->maxLength(50)->unique(ignoreRecord: true),
                    TextInput::make('surname')->required()->maxLength(255),
                    TextInput::make('first_name')->required()->maxLength(255),
                    TextInput::make('other_names')->maxLength(255),
                    Select::make('gender')->options(['male' => 'Male', 'female' => 'Female'])->required(),
                    Toggle::make('is_qualified')->default(false),
                ])
                ->columns(3),

            Section::make('Employment & Contact')
                ->schema([
                    DatePicker::make('date_of_birth'),
                    DatePicker::make('date_of_first_appointment'),
                    Select::make('employment_status')->options([
                        'permanent' => 'Permanent',
                        'temporary' => 'Temporary',
                        'volunteer' => 'Volunteer',
                    ]),
                    TextInput::make('specialization')->maxLength(255),
                    TextInput::make('phone')->tel()->maxLength(30),
                    TextInput::make('email')->email()->maxLength(255),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('Name')->searchable(['surname', 'first_name', 'other_names'])->sortable(),
                Tables\Columns\TextColumn::make('staff_no')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('school.name')->label('School')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('qualification.name')->label('Qualification')->sortable(),
                Tables\Columns\TextColumn::make('gender')->badge(),
                Tables\Columns\IconColumn::make('is_qualified')->boolean(),
                Tables\Columns\TextColumn::make('employment_status')->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('qualification')->relationship('qualification', 'name'),
                Tables\Filters\SelectFilter::make('gender')->options(['male' => 'Male', 'female' => 'Female']),
                Tables\Filters\TernaryFilter::make('is_qualified'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}

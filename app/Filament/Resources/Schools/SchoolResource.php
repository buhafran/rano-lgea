<?php

namespace App\Filament\Resources\Schools;

use App\Filament\Resources\Schools\Pages;
use App\Models\School;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';
    protected static string|\UnitEnum|null $navigationGroup = 'School Management';

    public static function form(Schema $schema): Schema
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('ward.name')->label('Ward')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('schoolLevel.name')->label('Level')->sortable(),
                Tables\Columns\TextColumn::make('ownershipType.name')->label('Ownership')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('teachers_count')->counts('teachers')->label('Teachers'),
                Tables\Columns\TextColumn::make('students_count')->counts('students')->label('Students'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('ward')->relationship('ward', 'name'),
                Tables\Filters\SelectFilter::make('schoolLevel')->relationship('schoolLevel', 'name'),
                Tables\Filters\SelectFilter::make('ownershipType')->relationship('ownershipType', 'name'),
                Tables\Filters\TernaryFilter::make('is_active'),
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}

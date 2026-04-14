<?php

namespace App\Filament\Resources\Students;

use App\Filament\Resources\Students\Pages;
use App\Models\Student;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static string|\UnitEnum|null $navigationGroup = 'Students & Enrollment';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
{
    $query = parent::getEloquentQuery();
    $user = auth()->user();

    if (! $user) {
        return $query;
    }

    if ($user->hasAnyRole(['Super Admin', 'LGEA Admin', 'EMIS Officer'])) {
        return $query;
    }

        return $query->where('school_id', $user->school_id);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Student Information')
                ->schema([
                    Select::make('school_id')->relationship('school', 'name')->searchable()->preload(),
                    TextInput::make('admission_no')->maxLength(50)->unique(ignoreRecord: true),
                    TextInput::make('surname')->required()->maxLength(255),
                    TextInput::make('first_name')->required()->maxLength(255),
                    TextInput::make('other_names')->maxLength(255),
                    Select::make('gender')->options(['male' => 'Male', 'female' => 'Female'])->required(),
                    DatePicker::make('date_of_birth'),
                    TextInput::make('entry_age')->numeric()->minValue(1)->maxValue(30),
                    Toggle::make('is_active')->default(true),
                ])
                ->columns(3),

            Section::make('Guardian')
                ->schema([
                    TextInput::make('guardian_name')->maxLength(255),
                    TextInput::make('guardian_phone')->tel()->maxLength(30),
                    Textarea::make('address')->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('Name')->searchable(['surname', 'first_name', 'other_names'])->sortable(),
                Tables\Columns\TextColumn::make('admission_no')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('school.name')->label('School')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('gender')->badge(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('date_of_birth')->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('gender')->options(['male' => 'Male', 'female' => 'Female']),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
    
}

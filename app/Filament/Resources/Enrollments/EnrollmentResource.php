<?php

namespace App\Filament\Resources\Enrollments;

use App\Filament\Resources\Enrollments\Pages;
use App\Models\Enrollment;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string|\UnitEnum|null $navigationGroup = 'Students & Enrollment';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Enrollment')
                ->schema([
                    Select::make('student_id')
                        ->relationship('student', 'surname')
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('school_id')->relationship('school', 'name')->searchable()->preload()->required(),
                    Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload()->required(),
                    Select::make('term_id')->relationship('term', 'name')->searchable()->preload(),
                    Select::make('class_level_id')->relationship('classLevel', 'name')->searchable()->preload()->required(),
                    Toggle::make('is_new_intake')->default(false),
                    TextInput::make('entry_age')->numeric()->minValue(1)->maxValue(30),
                    Select::make('enrollment_status')->options([
                        'active' => 'Active',
                        'transferred' => 'Transferred',
                        'graduated' => 'Graduated',
                        'repeated' => 'Repeated',
                        'dropped_out' => 'Dropped Out',
                    ])->default('active')->required(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')->label('Student')->searchable(['student.surname', 'student.first_name'])->sortable(),
                Tables\Columns\TextColumn::make('school.name')->label('School')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->sortable(),
                Tables\Columns\TextColumn::make('term.name')->label('Term')->sortable(),
                Tables\Columns\TextColumn::make('classLevel.name')->label('Class')->sortable(),
                Tables\Columns\IconColumn::make('is_new_intake')->boolean(),
                Tables\Columns\TextColumn::make('enrollment_status')->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('academicSession')->relationship('academicSession', 'name'),
                Tables\Filters\SelectFilter::make('term')->relationship('term', 'name'),
                Tables\Filters\SelectFilter::make('classLevel')->relationship('classLevel', 'name'),
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
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            'edit' => Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }
}

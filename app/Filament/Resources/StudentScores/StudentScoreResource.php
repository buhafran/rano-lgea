<?php

namespace App\Filament\Resources\StudentScores;

use App\Filament\Resources\StudentScores\Pages;
use App\Models\StudentScore;
use App\Services\ResultComputationService;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class StudentScoreResource extends Resource
{
    protected static ?string $model = StudentScore::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static string|\UnitEnum|null $navigationGroup = 'Academics & Results';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Score Entry')
                ->schema([
                    Select::make('student_id')
                        ->relationship('student', 'surname')
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('school_id')->relationship('school', 'name')->searchable()->preload()->required(),
                    Select::make('academic_session_id')->relationship('academicSession', 'name')->searchable()->preload()->required(),
                    Select::make('term_id')->relationship('term', 'name')->searchable()->preload()->required(),
                    Select::make('class_level_id')->relationship('classLevel', 'name')->searchable()->preload()->required(),
                    Select::make('subject_id')->relationship('subject', 'name')->searchable()->preload()->required(),
                    TextInput::make('ca_score')
                        ->numeric()
                        ->default(0)
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($get, $set) {
                            $ca = (float) ($get('ca_score') ?? 0);
                            $exam = (float) ($get('exam_score') ?? 0);
                            $set('total_score', $ca + $exam);
                        }),
                    TextInput::make('exam_score')
                        ->numeric()
                        ->default(0)
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($get, $set) {
                            $ca = (float) ($get('ca_score') ?? 0);
                            $exam = (float) ($get('exam_score') ?? 0);
                            $set('total_score', $ca + $exam);
                        }),
                    TextInput::make('total_score')->numeric()->disabled()->dehydrated(),
                    TextInput::make('grade')->disabled()->dehydrated(),
                    TextInput::make('remark')->disabled()->dehydrated(),
                ])
                ->columns(3),
        ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $computed = app(ResultComputationService::class)->compute(
            (float) ($data['ca_score'] ?? 0),
            (float) ($data['exam_score'] ?? 0),
            $data['school_id'] ?? null
        );

        return array_merge($data, $computed, [
            'entered_by' => auth()->id(),
        ]);
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        $computed = app(ResultComputationService::class)->compute(
            (float) ($data['ca_score'] ?? 0),
            (float) ($data['exam_score'] ?? 0),
            $data['school_id'] ?? null
        );

        return array_merge($data, $computed);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')->label('Student')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('subject.name')->label('Subject')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('classLevel.name')->label('Class')->sortable(),
                Tables\Columns\TextColumn::make('term.name')->label('Term')->sortable(),
                Tables\Columns\TextColumn::make('academicSession.name')->label('Session')->sortable(),
                Tables\Columns\TextColumn::make('ca_score')->numeric(decimalPlaces: 2)->sortable(),
                Tables\Columns\TextColumn::make('exam_score')->numeric(decimalPlaces: 2)->sortable(),
                Tables\Columns\TextColumn::make('total_score')->numeric(decimalPlaces: 2)->sortable(),
                Tables\Columns\TextColumn::make('grade')->badge(),
                Tables\Columns\TextColumn::make('remark')->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')->relationship('school', 'name'),
                Tables\Filters\SelectFilter::make('academicSession')->relationship('academicSession', 'name'),
                Tables\Filters\SelectFilter::make('term')->relationship('term', 'name'),
                Tables\Filters\SelectFilter::make('classLevel')->relationship('classLevel', 'name'),
                Tables\Filters\SelectFilter::make('subject')->relationship('subject', 'name'),
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
            'index' => Pages\ListStudentScores::route('/'),
            'create' => Pages\CreateStudentScore::route('/create'),
            'edit' => Pages\EditStudentScore::route('/{record}/edit'),
        ];
    }
}

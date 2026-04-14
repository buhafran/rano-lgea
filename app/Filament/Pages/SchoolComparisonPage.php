<?php

namespace App\Filament\Pages;

use App\Models\AcademicSession;
use App\Models\SchoolYearProfile;
use Filament\Pages\Page;

class SchoolComparisonPage extends Page
{
    protected string $view = 'filament.pages.school-comparison-page';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static string|\UnitEnum|null $navigationGroup = 'Indicators & Census';

    public ?int $academicSessionId = null;

    public function mount(): void
    {
        $this->academicSessionId = AcademicSession::where('is_current', true)->value('id');
    }

    public function getComparisonRowsProperty()
    {
        return SchoolYearProfile::with('school')
            ->when($this->academicSessionId, fn ($q) => $q->where('academic_session_id', $this->academicSessionId))
            ->get()
            ->map(function ($row) {
                return [
                    'school' => $row->school?->name,
                    'primary_enrolment' => $row->primary_total,
                    'teachers' => $row->total_teachers,
                    'usable_classrooms' => $row->usable_classrooms,
                    'water' => $row->has_water_source ? 'Yes' : 'No',
                    'health' => $row->has_health_facility ? 'Yes' : 'No',
                ];
            });
    }
}
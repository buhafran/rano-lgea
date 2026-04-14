<?php

namespace App\Filament\Pages;

use App\Models\AcademicSession;
use App\Models\School;
use Filament\Pages\Page;

class WardComparisonPage extends Page
{

    protected string $view = 'filament.pages.ward-comparison-page';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';
    protected static string|\UnitEnum|null $navigationGroup = 'Indicators & Census';

    public ?int $academicSessionId = null;

    public function mount(): void
    {
        $this->academicSessionId = AcademicSession::where('is_current', true)->value('id');
    }

    public function getRowsProperty()
    {
        return School::with(['ward', 'schoolYearProfiles' => fn ($q) => $q->where('academic_session_id', $this->academicSessionId)])
            ->get()
            ->groupBy(fn ($school) => $school->ward?->name ?? 'Unknown')
            ->map(function ($schools, $ward) {
                return [
                    'ward' => $ward,
                    'schools' => $schools->count(),
                    'primary_enrolment' => $schools->sum(fn ($school) => optional($school->schoolYearProfiles->first())->primary_total ?? 0),
                    'teachers' => $schools->sum(fn ($school) => optional($school->schoolYearProfiles->first())->total_teachers ?? 0),
                ];
            })
            ->values();
    }
}
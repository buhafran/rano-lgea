<?php

namespace App\Services;

use App\Models\IndicatorValue;
use App\Models\SchoolYearProfile;
use App\Models\StudentScore;
use Illuminate\Support\Collection;

class ReportExportService
{
    public function schoolInventorySummary(?int $academicSessionId = null): Collection
    {
        return SchoolYearProfile::query()
            ->with(['school', 'academicSession'])
            ->when($academicSessionId, fn ($q) => $q->where('academic_session_id', $academicSessionId))
            ->get()
            ->map(function ($row) {
                return [
                    'school' => $row->school?->name,
                    'session' => $row->academicSession?->name,
                    'primary_enrolment' => $row->primary_total,
                    'pre_primary_enrolment' => $row->pre_primary_total,
                    'teachers' => $row->total_teachers,
                    'usable_classrooms' => $row->usable_classrooms,
                    'has_water_source' => $row->has_water_source ? 'Yes' : 'No',
                    'has_health_facility' => $row->has_health_facility ? 'Yes' : 'No',
                ];
            });
    }

    public function indicatorSummary(?int $academicSessionId = null): Collection
    {
        return IndicatorValue::query()
            ->with(['indicatorDefinition', 'academicSession', 'school'])
            ->when($academicSessionId, fn ($q) => $q->where('academic_session_id', $academicSessionId))
            ->get()
            ->map(function ($row) {
                return [
                    'indicator' => $row->indicatorDefinition?->code,
                    'name' => $row->indicatorDefinition?->name,
                    'session' => $row->academicSession?->name,
                    'school' => $row->school?->name,
                    'male_value' => $row->male_value,
                    'female_value' => $row->female_value,
                    'total_value' => $row->total_value,
                    'source' => $row->source,
                ];
            });
    }

    public function resultSummary(?int $academicSessionId = null, ?int $termId = null, ?int $schoolId = null): Collection
    {
        return StudentScore::query()
            ->with(['student', 'subject', 'academicSession', 'term', 'school'])
            ->when($academicSessionId, fn ($q) => $q->where('academic_session_id', $academicSessionId))
            ->when($termId, fn ($q) => $q->where('term_id', $termId))
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
            ->get()
            ->map(function ($row) {
                return [
                    'student' => $row->student?->full_name,
                    'school' => $row->school?->name,
                    'session' => $row->academicSession?->name,
                    'term' => $row->term?->name,
                    'subject' => $row->subject?->name,
                    'ca_score' => $row->ca_score,
                    'exam_score' => $row->exam_score,
                    'total_score' => $row->total_score,
                    'grade' => $row->grade,
                ];
            });
    }
}
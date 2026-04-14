<?php

namespace App\Services;

use App\Models\StudentScore;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ResultAnalyticsService
{
    public function averageBySubject(int $academicSessionId, ?int $termId = null, ?int $schoolId = null): Collection
    {
        return StudentScore::query()
            ->select('subject_id', DB::raw('AVG(total_score) as average_score'))
            ->when($academicSessionId, fn ($q) => $q->where('academic_session_id', $academicSessionId))
            ->when($termId, fn ($q) => $q->where('term_id', $termId))
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
            ->with('subject:id,name')
            ->groupBy('subject_id')
            ->get();
    }

    public function passFailSummary(int $academicSessionId, ?int $termId = null, ?int $schoolId = null): array
    {
        $query = StudentScore::query()
            ->when($academicSessionId, fn ($q) => $q->where('academic_session_id', $academicSessionId))
            ->when($termId, fn ($q) => $q->where('term_id', $termId))
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId));

        $pass = (clone $query)->where('total_score', '>=', 40)->count();
        $fail = (clone $query)->where('total_score', '<', 40)->count();

        return [
            'pass' => $pass,
            'fail' => $fail,
        ];
    }
}
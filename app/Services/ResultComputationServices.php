<?php

namespace App\Services;

use App\Models\GradingScale;
use App\Models\StudentScore;

class ResultComputationService
{
    public function compute(float $caScore, float $examScore, ?int $schoolId = null): array
    {
        $total = round($caScore + $examScore, 2);

        $scale = GradingScale::query()
            ->where(function ($query) use ($schoolId): void {
                $query->where('school_id', $schoolId)->orWhereNull('school_id');
            })
            ->where('min_score', '<=', $total)
            ->where('max_score', '>=', $total)
            ->orderByRaw('school_id is null')
            ->first();

        return [
            'total_score' => $total,
            'grade' => $scale?->grade,
            'remark' => $scale?->remark,
        ];
    }

    public function apply(StudentScore $score): StudentScore
    {
        $score->fill(
            $this->compute((float) $score->ca_score, (float) $score->exam_score, $score->school_id)
        );

        return $score;
    }
}

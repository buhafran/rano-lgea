<?php

namespace App\Services;

use App\Models\IndicatorDefinition;
use App\Models\IndicatorValue;
use App\Models\PopulationStatistic;
use App\Models\PrivateEnrollmentStatistic;
use App\Models\SchoolYearProfile;
use App\Models\Teacher;
use App\Models\Enrollment;

class IndicatorService
{
    public function saveOrUpdateValue(
        string $code,
        int $academicSessionId,
        ?float $maleValue = null,
        ?float $femaleValue = null,
        ?float $totalValue = null,
        ?int $schoolId = null,
        ?int $termId = null,
        ?int $wardId = null,
        ?string $lgaName = 'RANO',
        string $source = 'computed',
        ?string $notes = null,
    ): IndicatorValue {
        $definition = IndicatorDefinition::where('code', $code)->firstOrFail();

        return IndicatorValue::updateOrCreate(
            [
                'indicator_definition_id' => $definition->id,
                'academic_session_id' => $academicSessionId,
                'school_id' => $schoolId,
                'term_id' => $termId,
                'ward_id' => $wardId,
                'lga_name' => $lgaName,
            ],
            [
                'male_value' => $maleValue,
                'female_value' => $femaleValue,
                'total_value' => $totalValue,
                'source' => $source,
                'notes' => $notes,
            ]
        );
    }

    public function computePTR(int $schoolId, int $academicSessionId): ?float
    {
        $profile = SchoolYearProfile::where('school_id', $schoolId)
            ->where('academic_session_id', $academicSessionId)
            ->first();

        if (! $profile) {
            return null;
        }

        $totalPupils = $profile->primary_total + $profile->pre_primary_total;
        $totalTeachers = $profile->total_teachers;

        if ($totalTeachers <= 0) {
            return null;
        }

        return round($totalPupils / $totalTeachers, 2);
    }

    public function computePQT(int $schoolId): ?float
    {
        $totalTeachers = Teacher::where('school_id', $schoolId)->count();

        if ($totalTeachers <= 0) {
            return null;
        }

        $qualifiedTeachers = Teacher::where('school_id', $schoolId)
            ->where('is_qualified', true)
            ->count();

        return round(($qualifiedTeachers / $totalTeachers) * 100, 2);
    }

    public function computePFT(int $schoolId): ?float
    {
        $totalTeachers = Teacher::where('school_id', $schoolId)->count();

        if ($totalTeachers <= 0) {
            return null;
        }

        $femaleTeachers = Teacher::where('school_id', $schoolId)
            ->where('gender', 'female')
            ->count();

        return round(($femaleTeachers / $totalTeachers) * 100, 2);
    }

    public function computePPE(int $academicSessionId, string $lgaName = 'RANO'): ?float
    {
        $privateEnrollment = PrivateEnrollmentStatistic::where('academic_session_id', $academicSessionId)
            ->where('lga_name', $lgaName)
            ->sum('total');

        $publicEnrollment = SchoolYearProfile::where('academic_session_id', $academicSessionId)
            ->get()
            ->sum(fn ($row) => $row->primary_total + $row->pre_primary_total);

        $totalEnrollment = $privateEnrollment + $publicEnrollment;

        if ($totalEnrollment <= 0) {
            return null;
        }

        return round(($privateEnrollment / $totalEnrollment) * 100, 2);
    }

    public function computeGER(int $academicSessionId): ?float
    {
        $totalEnrolment = SchoolYearProfile::where('academic_session_id', $academicSessionId)
            ->get()
            ->sum(fn ($row) => $row->primary_total);

        $schoolAgePopulation = PopulationStatistic::where('academic_session_id', $academicSessionId)
            ->whereBetween('age', [6, 11])
            ->sum('population');

        if ($schoolAgePopulation <= 0) {
            return null;
        }

        return round(($totalEnrolment / $schoolAgePopulation) * 100, 2);
    }

    public function computeNER(int $academicSessionId): ?float
    {
        $eligibleEnrolment = Enrollment::query()
            ->where('academic_session_id', $academicSessionId)
            ->whereHas('student', function ($query): void {
                $query->whereBetween('entry_age', [6, 11]);
            })
            ->count();

        $schoolAgePopulation = PopulationStatistic::where('academic_session_id', $academicSessionId)
            ->whereBetween('age', [6, 11])
            ->sum('population');

        if ($schoolAgePopulation <= 0) {
            return null;
        }

        return round(($eligibleEnrolment / $schoolAgePopulation) * 100, 2);
    }

    public function computeGPI(?float $femaleValue, ?float $maleValue): ?float
    {
        if (! $maleValue || $maleValue <= 0) {
            return null;
        }

        return round(($femaleValue ?? 0) / $maleValue, 2);
    }

    public function computeSchoolIndicators(int $schoolId, int $academicSessionId): void
    {
        $ptr = $this->computePTR($schoolId, $academicSessionId);
        $pqt = $this->computePQT($schoolId);
        $pft = $this->computePFT($schoolId);

        if ($ptr !== null) {
            $this->saveOrUpdateValue('PTR', $academicSessionId, totalValue: $ptr, schoolId: $schoolId);
        }

        if ($pqt !== null) {
            $this->saveOrUpdateValue('PQT', $academicSessionId, totalValue: $pqt, schoolId: $schoolId);
        }

        if ($pft !== null) {
            $this->saveOrUpdateValue('PFT', $academicSessionId, totalValue: $pft, schoolId: $schoolId);
        }
    }

    public function computeLgaIndicators(int $academicSessionId, string $lgaName = 'RANO'): void
    {
        $ger = $this->computeGER($academicSessionId);
        $ner = $this->computeNER($academicSessionId);
        $ppe = $this->computePPE($academicSessionId, $lgaName);

        if ($ger !== null) {
            $this->saveOrUpdateValue('GER', $academicSessionId, totalValue: $ger, lgaName: $lgaName);
        }

        if ($ner !== null) {
            $this->saveOrUpdateValue('NER', $academicSessionId, totalValue: $ner, lgaName: $lgaName);
        }

        if ($ppe !== null) {
            $this->saveOrUpdateValue('PPE', $academicSessionId, totalValue: $ppe, lgaName: $lgaName);
        }
    }
}
<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolYearProfile extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'school_id',
        'academic_session_id',
        'pre_primary_enrollment_male',
        'pre_primary_enrollment_female',
        'primary_enrollment_male',
        'primary_enrollment_female',
        'total_teachers_male',
        'total_teachers_female',
        'qualified_teachers',
        'female_teachers',
        'usable_classrooms',
        'total_classrooms',
        'pupils_per_classroom',
        'pupil_toilet_ratio',
        'has_water_source',
        'has_health_facility',
        'blackboards_in_good_condition',
        'total_blackboards',
        'remarks',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'pupils_per_classroom' => 'decimal:2',
        'pupil_toilet_ratio' => 'decimal:2',
        'has_water_source' => 'boolean',
        'has_health_facility' => 'boolean',
    ];

    protected $appends = [
        'pre_primary_total',
        'primary_total',
        'total_teachers',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function getPrePrimaryTotalAttribute(): int
    {
        return (int) $this->pre_primary_enrollment_male + (int) $this->pre_primary_enrollment_female;
    }

    public function getPrimaryTotalAttribute(): int
    {
        return (int) $this->primary_enrollment_male + (int) $this->primary_enrollment_female;
    }

    public function getTotalTeachersAttribute(): int
    {
        return (int) $this->total_teachers_male + (int) $this->total_teachers_female;
    }
}
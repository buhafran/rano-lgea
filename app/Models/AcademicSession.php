<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicSession extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_current',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(StudentScore::class);
    }
    public function schoolYearProfiles(): HasMany
{
    return $this->hasMany(SchoolYearProfile::class);
}

public function schoolFacilities(): HasMany
{
    return $this->hasMany(SchoolFacility::class);
}

public function schoolAssets(): HasMany
{
    return $this->hasMany(SchoolAsset::class);
}
public function indicatorValues(): HasMany
{
    return $this->hasMany(IndicatorValue::class);
}

public function populationStatistics(): HasMany
{
    return $this->hasMany(PopulationStatistic::class);
}

public function privateEnrollmentStatistics(): HasMany
{
    return $this->hasMany(PrivateEnrollmentStatistic::class);
}

public function annualCensusImports(): HasMany
{
    return $this->hasMany(AnnualCensusImport::class);
}
public function resultPublications(): HasMany
{
    return $this->hasMany(ResultPublication::class);
}
}
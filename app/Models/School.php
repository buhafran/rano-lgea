<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'ward_id',
        'ownership_type_id',
        'school_level_id',
        'name',
        'code',
        'emis_code',
        'address',
        'latitude',
        'longitude',
        'established_year',
        'head_teacher_name',
        'phone',
        'email',
        'is_active',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_active' => 'boolean',
    ];

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function ownershipType(): BelongsTo
    {
        return $this->belongsTo(SchoolOwnershipType::class, 'ownership_type_id');
    }

    public function schoolLevel(): BelongsTo
    {
        return $this->belongsTo(SchoolLevel::class);
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

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

public function facilities(): HasMany
{
    return $this->hasMany(SchoolFacility::class);
}

public function assets(): HasMany
{
    return $this->hasMany(SchoolAsset::class);
}

public function maintenanceRecords(): HasMany
{
    return $this->hasMany(MaintenanceRecord::class);
}
public function indicatorValues(): HasMany
{
    return $this->hasMany(IndicatorValue::class);
}
public function resultPublications(): HasMany
{
    return $this->hasMany(ResultPublication::class);
}
}

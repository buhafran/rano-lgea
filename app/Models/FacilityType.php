<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FacilityType extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'name',
        'code',
        'description',
        'createdby',
        'updatedby',
    ];

    public function schoolFacilities(): HasMany
    {
        return $this->hasMany(SchoolFacility::class);
    }

    public function maintenanceRecords(): HasMany
    {
        return $this->hasMany(MaintenanceRecord::class);
    }
}
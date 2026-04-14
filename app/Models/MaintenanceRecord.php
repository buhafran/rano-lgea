<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRecord extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'school_id',
        'facility_type_id',
        'asset_type_id',
        'title',
        'description',
        'status',
        'reported_date',
        'resolved_date',
        'estimated_cost',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'reported_date' => 'date',
        'resolved_date' => 'date',
        'estimated_cost' => 'decimal:2',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function facilityType(): BelongsTo
    {
        return $this->belongsTo(FacilityType::class);
    }

    public function assetType(): BelongsTo
    {
        return $this->belongsTo(AssetType::class);
    }
}
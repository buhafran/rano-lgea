<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolAsset extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'school_id',
        'asset_type_id',
        'academic_session_id',
        'quantity',
        'functional_quantity',
        'condition',
        'notes',
        'createdby',
        'updatedby',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function assetType(): BelongsTo
    {
        return $this->belongsTo(AssetType::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }
}
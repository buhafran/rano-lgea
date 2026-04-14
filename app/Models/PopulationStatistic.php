<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PopulationStatistic extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'ward_id',
        'lga_name',
        'academic_session_id',
        'age',
        'gender',
        'population',
        'createdby',
        'updatedby',
    ];

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }
}
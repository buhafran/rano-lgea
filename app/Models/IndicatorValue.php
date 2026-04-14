<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndicatorValue extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'indicator_definition_id',
        'school_id',
        'academic_session_id',
        'term_id',
        'ward_id',
        'lga_name',
        'male_value',
        'female_value',
        'total_value',
        'source',
        'notes',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'male_value' => 'decimal:2',
        'female_value' => 'decimal:2',
        'total_value' => 'decimal:2',
    ];

    public function indicatorDefinition(): BelongsTo
    {
        return $this->belongsTo(IndicatorDefinition::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }
}
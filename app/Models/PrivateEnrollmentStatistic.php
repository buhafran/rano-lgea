<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateEnrollmentStatistic extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'academic_session_id',
        'lga_name',
        'level',
        'male',
        'female',
        'total',
        'source_document',
        'createdby',
        'updatedby',
    ];

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }
}
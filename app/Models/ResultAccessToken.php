<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultAccessToken extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'student_id',
        'academic_session_id',
        'term_id',
        'access_code',
        'is_used',
        'used_at',
        'expires_at',
        'generated_by',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function isExpired(): bool
    {
        return filled($this->expires_at) && now()->greaterThan($this->expires_at);
    }
}
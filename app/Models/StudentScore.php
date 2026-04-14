<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentScore extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'student_id',
        'school_id',
        'academic_session_id',
        'term_id',
        'class_level_id',
        'subject_id',
        'ca_score',
        'exam_score',
        'total_score',
        'grade',
        'remark',
        'entered_by',
        'approved_by',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'ca_score' => 'decimal:2',
        'exam_score' => 'decimal:2',
        'total_score' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::saving(function (StudentScore $score): void {
            $score->total_score = (float) $score->ca_score + (float) $score->exam_score;
        });
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
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

    public function classLevel(): BelongsTo
    {
        return $this->belongsTo(ClassLevel::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
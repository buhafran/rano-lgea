<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'school_id',
        'qualification_id',
        'staff_no',
        'surname',
        'first_name',
        'other_names',
        'gender',
        'phone',
        'email',
        'date_of_birth',
        'date_of_first_appointment',
        'employment_status',
        'is_qualified',
        'specialization',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_first_appointment' => 'date',
        'is_qualified' => 'boolean',
    ];

    protected $appends = ['full_name'];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(TeacherQualification::class, 'qualification_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim(collect([$this->surname, $this->first_name, $this->other_names])->filter()->implode(' '));
    }
}
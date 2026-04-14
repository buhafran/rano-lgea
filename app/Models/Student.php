<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'school_id',
        'admission_no',
        'surname',
        'first_name',
        'other_names',
        'gender',
        'date_of_birth',
        'entry_age',
        'guardian_name',
        'guardian_phone',
        'address',
        'is_active',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
    ];

    protected $appends = ['full_name'];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(StudentScore::class);
    }
    public function resultAccessTokens(): HasMany
    {
        return $this->hasMany(ResultAccessToken::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim(collect([$this->surname, $this->first_name, $this->other_names])->filter()->implode(' '));
    }
    
}
<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeacherQualification extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'name',
        'is_minimum_required',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'is_minimum_required' => 'boolean',
    ];

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class, 'qualification_id');
    }
}
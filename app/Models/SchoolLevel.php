<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolLevel extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'name',
        'code',
        'createdby',
        'updatedby',
    ];

    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function classLevels(): HasMany
    {
        return $this->hasMany(ClassLevel::class);
    }
}

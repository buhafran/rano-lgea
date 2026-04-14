<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'name',
        'code',
        'sort_order',
        'createdby',
        'updatedby',
    ];

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(StudentScore::class);
    }
    public function indicatorValues(): HasMany
{
    return $this->hasMany(IndicatorValue::class);
}
}
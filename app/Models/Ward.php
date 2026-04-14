<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
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
    public function indicatorValues(): HasMany
{
    return $this->hasMany(IndicatorValue::class);
}

public function populationStatistics(): HasMany
{
    return $this->hasMany(PopulationStatistic::class);
}
}

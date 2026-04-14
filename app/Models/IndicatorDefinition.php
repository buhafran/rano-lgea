<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndicatorDefinition extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'code',
        'name',
        'description',
        'formula',
        'level',
        'data_type',
        'is_calculated',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'is_calculated' => 'boolean',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(IndicatorValue::class);
    }
}
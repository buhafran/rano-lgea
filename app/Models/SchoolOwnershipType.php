<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolOwnershipType extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'name',
        'createdby',
        'updatedby',
    ];

    public function schools(): HasMany
    {
        return $this->hasMany(School::class, 'ownership_type_id');
    }
}
<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TracksUserStamps
{
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'createdby', 'id');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updatedby', 'id');
    }

    protected static function bootTracksUserStamps(): void
    {
        static::creating(function ($model): void {
            if (auth()->check()) {
                $model->createdby ??= auth()->id();
                $model->updatedby ??= auth()->id();
            }
        });

        static::updating(function ($model): void {
            if (auth()->check()) {
                $model->updatedby = auth()->id();
            }
        });
    }
}
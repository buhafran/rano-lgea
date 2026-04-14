<?php

namespace App\Traits;
use App\Services\AuditLogService;

trait Auditable
{
    public static function bootAuditable()
    {
        static::creating(function ($model) {
            app(AuditLogService::class)->log(
                action: 'created',
                model: $model,
                oldValues: [],
                newValues: $model->getAttributes(),
            );
        });

        static::updating(function ($model) {
            app(AuditLogService::class)->log(
                action: 'updated',
                model: $model,
                oldValues: $model->getOriginal(),
                newValues: $model->getDirty(),
            );
        });

        static::deleting(function ($model) {
            app(AuditLogService::class)->log(
                action: 'deleted',
                model: $model,
                oldValues: $model->getOriginal(),
                newValues: [],
            );
        });
    }
}

<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class SchoolScopeService
{
    public function apply(Builder $query, ?int $schoolId): Builder
    {
        if (! $schoolId) {
            return $query;
        }

        return $query->where('school_id', $schoolId);
    }

    public function currentUserSchoolId(): ?int
    {
        $user = auth()->user();

        if (! $user) {
            return null;
        }

        if ($user->hasAnyRole(['Super Admin', 'LGEA Admin', 'EMIS Officer'])) {
            return null;
        }

        return $user->school_id;
    }
}
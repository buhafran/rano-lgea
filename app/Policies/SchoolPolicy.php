<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;

class SchoolPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view schools');
    }

    public function view(User $user, School $school): bool
    {
        if (! $user->can('view schools')) {
            return false;
        }

        if ($user->hasAnyRole(['Super Admin', 'LGEA Admin', 'EMIS Officer'])) {
            return true;
        }

        return $user->school_id === $school->id;
    }

    public function create(User $user): bool
    {
        return $user->can('create schools');
    }

    public function update(User $user, School $school): bool
    {
        if (! $user->can('update schools')) {
            return false;
        }

        if ($user->hasAnyRole(['Super Admin', 'LGEA Admin'])) {
            return true;
        }

        return $user->school_id === $school->id;
    }

    public function delete(User $user, School $school): bool
    {
        return $user->can('delete schools');
    }
}
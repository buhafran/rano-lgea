<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;

class TeacherPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view teachers');
    }

    public function view(User $user, Teacher $teacher): bool
    {
        if (! $user->can('view teachers')) {
            return false;
        }

        if ($user->hasAnyRole(['Super Admin', 'LGEA Admin', 'EMIS Officer'])) {
            return true;
        }

        return $user->school_id === $teacher->school_id;
    }

    public function create(User $user): bool
    {
        return $user->can('create teachers');
    }

    public function update(User $user, Teacher $teacher): bool
    {
        if (! $user->can('update teachers')) {
            return false;
        }

        if ($user->hasAnyRole(['Super Admin', 'LGEA Admin'])) {
            return true;
        }

        return $user->school_id === $teacher->school_id;
    }

    public function delete(User $user, Teacher $teacher): bool
    {
        return $user->can('delete teachers');
    }
}
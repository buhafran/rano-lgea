<?php

namespace App\Policies;

use App\Models\AnnualCensusImport;
use App\Models\User;

class AnnualCensusImportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view imports');
    }

    public function view(User $user, AnnualCensusImport $import): bool
    {
        return $user->can('view imports');
    }

    public function create(User $user): bool
    {
        return $user->can('create imports');
    }

    public function update(User $user, AnnualCensusImport $import): bool
    {
        return $user->can('create imports');
    }

    public function approve(User $user, AnnualCensusImport $import): bool
    {
        return $user->can('approve imports');
    }

    public function reject(User $user, AnnualCensusImport $import): bool
    {
        return $user->can('reject imports');
    }
}
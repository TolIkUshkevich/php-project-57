<?php

namespace App\Policies;

use App\Models\User;

class StatusPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
        return $user != null;
    }

    public function update(User $user): bool
    {
        return $user != null;
    }

    public function destroy(User $user): bool
    {
        return $user != null;
    }
}

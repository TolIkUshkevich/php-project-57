<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
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

    public function destroy(User $user, Task $task): bool
    {
        return $user->id === $task->created_by_id;
    }
}

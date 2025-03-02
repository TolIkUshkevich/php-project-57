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
        
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->created_by_id;
    }
}

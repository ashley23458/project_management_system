<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Task $task)
    {
        return $user->company_id === $task->project->company_id;
    }
}

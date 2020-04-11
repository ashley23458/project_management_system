<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Project $project)
    {
        return $user->company_id === $project->company_id;
    }
}

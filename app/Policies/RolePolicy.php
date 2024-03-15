<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function deleteRole(User $user, Role $model)
    {
        return !$user->roles()->contains($model);
    }
}

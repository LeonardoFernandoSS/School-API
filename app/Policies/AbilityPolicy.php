<?php

namespace App\Policies;

use App\Models\Ability;
use App\Models\User;

class AbilityPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function deleteAbility(User $user, Ability $model)
    {
        return !$user->abilities()->contains($model);
    }
}

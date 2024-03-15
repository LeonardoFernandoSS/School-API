<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageUser(User $user, User $model)
    {
        return $user->id != $model->id;
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::USER_MANAGE);
    }
}

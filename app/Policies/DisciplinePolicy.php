<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\Discipline;
use App\Models\User;

class DisciplinePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageUser(User $user, Discipline $model)
    {
        return $user->id != $model->id;
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::DISCIPLINE_MANAGE);
    }
}

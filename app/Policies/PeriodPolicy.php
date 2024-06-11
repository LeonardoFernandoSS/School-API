<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\Period;
use App\Models\User;

class PeriodPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageUser(User $user, Period $model)
    {
        return $user->id != $model->id;
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::PERIOD_MANAGE);
    }
}

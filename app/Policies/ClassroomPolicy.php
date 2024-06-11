<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\Classroom;
use App\Models\User;

class ClassroomPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageUser(User $user, Classroom $model)
    {
        return $user->id != $model->id;
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::CLASSROOM_MANAGE);
    }
}

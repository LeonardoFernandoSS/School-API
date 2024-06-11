<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\Curriculum;
use App\Models\User;

class CurriculumPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageUser(User $user, Curriculum $model)
    {
        return $user->id != $model->id;
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::CURRICULUM_MANAGE);
    }
}

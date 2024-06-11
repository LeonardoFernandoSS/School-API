<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\Enrollment;
use App\Models\User;

class EnrollmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageUser(User $user, Enrollment $model)
    {
        return $user->id != $model->id;
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::ENROLLMENT_MANAGE);
    }
}

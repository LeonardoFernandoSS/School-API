<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\User;

class StudentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::STUDENT_MANAGE);
    }
}

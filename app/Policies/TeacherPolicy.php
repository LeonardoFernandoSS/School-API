<?php

namespace App\Policies;

use App\Enums\AbilityEnum;
use App\Models\Teacher;
use App\Models\User;

class TeacherPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manageTeacher(User $user, Teacher $model)
    {
        return $user->id != $model->id;
    }

    public function listDeleted(User $user)
    {
        return $user->tokenCan(AbilityEnum::TEACHER_MANAGE);
    }
}

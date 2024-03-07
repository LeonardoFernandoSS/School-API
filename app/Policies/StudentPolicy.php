<?php

namespace App\Policies;

use App\Models\Student;
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

    public function listDeletedStudent(User $user)
    {
        return $user->tokenCan('student-manage');
    }
}

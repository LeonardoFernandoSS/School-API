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

    public function createStudent(User $user)
    {
        return $user->tokenCan('manage-student');
    }

    public function editStudent(User $user)
    {
        return $user->tokenCan('manage-student');
    }

    public function deleteStudent(User $user)
    {
        return $user->tokenCan('manage-student');
    }

    public function detailStudent(User $user, Student $student)
    {
        return $user->tokenCan('detail-student');
    }
}

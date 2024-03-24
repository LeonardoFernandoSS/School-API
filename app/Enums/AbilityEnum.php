<?php

namespace App\Enums;

abstract class AbilityEnum
{
    const ABILITY = 'ability';
    const ROLE = 'role';
    const ROLE_MANAGE = 'role-manage';
    const USER = 'user';
    const USER_DETAIL = 'user-detail';
    const USER_MANAGE = 'user-manage';
    const STUDENT = 'student';
    const STUDENT_DETAIL = 'student-detail';
    const STUDENT_MANAGE = 'student-manage';

    public static function toArray()
    {
        $reflectionClass = new \ReflectionClass(static::class);
        
        return $reflectionClass->getConstants();
    }
}

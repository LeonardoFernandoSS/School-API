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
    const TEACHER = 'teacher';
    const TEACHER_DETAIL = 'teacher-detail';
    const TEACHER_MANAGE = 'teacher-manage';
    const PERIOD = 'period';
    const PERIOD_DETAIL = 'period-detail';
    const PERIOD_MANAGE = 'period-manage';
    const COURSE = 'course';
    const COURSE_DETAIL = 'course-detail';
    const COURSE_MANAGE = 'course-manage';
    const ENROLLMENT = 'enrollment';
    const ENROLLMENT_DETAIL = 'enrollment-detail';
    const ENROLLMENT_MANAGE = 'enrollment-manage';
    const DISCIPLINE = 'discipline';
    const DISCIPLINE_DETAIL = 'discipline-detail';
    const DISCIPLINE_MANAGE = 'discipline-manage';
    const CURRICULUM = 'curriculum';
    const CURRICULUM_DETAIL = 'curriculum-detail';
    const CURRICULUM_MANAGE = 'curriculum-manage';
    const CLASSROOM = 'classroom';
    const CLASSROOM_DETAIL = 'classroom-detail';
    const CLASSROOM_MANAGE = 'classroom-manage';

    public static function toArray()
    {
        $reflectionClass = new \ReflectionClass(static::class);
        
        return $reflectionClass->getConstants();
    }
}

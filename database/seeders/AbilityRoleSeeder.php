<?php

namespace Database\Seeders;

use App\Enums\AbilityEnum;
use App\Enums\RoleEnum;
use App\Models\Ability;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class AbilityRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Collection */
        $abilitiesAdmin = Ability::get();

        /** @var Role */
        $roleAdmin = Role::where('name', RoleEnum::ADMIN)->first();

        $roleAdmin->abilities()->sync($abilitiesAdmin->pluck('id'));

        /** @var Collection */
        $abilitiesTeacher = Ability::whereIn('name', [
            AbilityEnum::STUDENT, 
            AbilityEnum::STUDENT_DETAIL,
            AbilityEnum::COURSE,
            AbilityEnum::COURSE_DETAIL,
            AbilityEnum::ENROLLMENT,
            AbilityEnum::ENROLLMENT_DETAIL,
            AbilityEnum::DISCIPLINE,
            AbilityEnum::DISCIPLINE_DETAIL,
            AbilityEnum::CURRICULUM,
            AbilityEnum::CURRICULUM_DETAIL,
            AbilityEnum::CLASSROOM,
            AbilityEnum::CLASSROOM_DETAIL,
        ])->get();

        /** @var Role */
        $roleTeacher = Role::where('name', RoleEnum::TEACHER)->first();

        $roleTeacher->abilities()->sync($abilitiesTeacher->pluck('id'));
    }
}

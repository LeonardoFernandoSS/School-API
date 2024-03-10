<?php

namespace Database\Seeders;

use App\Enums\AbilityEnum;
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
        $roleAdmin = Role::where('name', 'admin')->first();

        $roleAdmin->abilities()->sync($abilitiesAdmin->pluck('id'));

        /** @var Collection */
        $abilitiesProfessor = Ability::whereIn('name', [AbilityEnum::STUDENT, AbilityEnum::STUDENT_DETAIL])->get();

        /** @var Role */
        $roleProfessor = Role::where('name', 'professor')->first();

        $roleProfessor->abilities()->sync($abilitiesProfessor->pluck('id'));
    }
}

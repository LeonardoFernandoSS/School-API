<?php

namespace Database\Seeders;

use App\Enums\AbilityEnum;
use App\Models\Ability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ability::create(['name' => AbilityEnum::STUDENT]);
        Ability::create(['name' => AbilityEnum::STUDENT_DETAIL]);
        Ability::create(['name' => AbilityEnum::STUDENT_MANAGE]);
    }
}

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
        $abilitiesEnum = AbilityEnum::toArray();

        foreach ($abilitiesEnum as $value) {
            Ability::create(['name' => $value]);
        }
    }
}

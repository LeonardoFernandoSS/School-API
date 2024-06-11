<?php

namespace Database\Seeders;

use App\Enums\PeriodsEnum;
use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodsEnum = PeriodsEnum::toArray();

        foreach ($periodsEnum as $value) {
            Period::create(['value' => $value]);
        }
    }
}

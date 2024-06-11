<?php

namespace Database\Seeders;

use App\Enums\PeriodsEnum;
use App\Models\Course;
use App\Models\Period;
use App\Models\Scopes\PeriodScope;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Period::withoutGlobalScope(PeriodScope::class)->where('value', PeriodsEnum::BIANNUAL)->first();

        Course::factory()->create(['period_id' => $role->id]);
    }
}

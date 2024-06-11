<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Discipline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Collection */
        $courses = Course::get();

        /** @var Collection */
        $disciplines = Discipline::get();

        /** @var Collection */
        $disciplinesChunks = $disciplines->chunk($disciplines->count() / $courses->count());

        $courses->each(function (Course $course) use ($disciplinesChunks) {

            $count = 1;

            $disciplinesChunks->each(function (Collection $disciplinesChunk) use ($course, $count) {

                $periodName = $count . 'º ' . $course->period->value;

                $disciplinesChunk->each(function (Discipline $discipline) use ($course, $periodName) {

                    Curriculum::factory()->create([
                        'period' => $periodName,
                        'course_id' => $course->id,
                        'discipline_id' => $discipline->id,
                    ]);
                });

                $count++;
            });

            $disciplinesChunks->pop(1);
        });
    }
}

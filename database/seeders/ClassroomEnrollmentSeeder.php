<?php

namespace Database\Seeders;

use App\Enums\DaytimeEnum;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ClassroomEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Collection */
        $enrollments = Enrollment::get();

        $daytimeEnum = DaytimeEnum::toArray();

        /** @var Collection */
        $enrollmentsChucks = $enrollments->chunk($enrollments->count() / count($daytimeEnum));
        
        foreach ($daytimeEnum as $value) {
            
            $enrollmentsChucks->each(function (Collection $enrollmentChucks) use ($value) {
                
                $enrollmentChucks->each(function (Enrollment $enrollment) use ($value) {

                    /** @var Course */
                    $course = $enrollment->course;
                    
                    $periodName = '1º ' . $course->period->value;

                    /** @var Collection */
                    $curricula = $course->curricula()->where('period', $periodName)->get();
                    
                    /** @var Collection */
                    $classrooms = $curricula->map->classrooms->flatten()->where('daytime', $value);
                    
                    $enrollment->classrooms()->sync($classrooms->pluck('id'));
                });
            });

            $enrollmentsChucks->pop(1);
        }
    }
}

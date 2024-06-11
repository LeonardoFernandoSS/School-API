<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Scopes\StudentScope;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Collection */
        $courses = Course::get();

        /** @var Collection */
        $students = Student::withoutGlobalScope(StudentScope::class)->get();
        
        $studentsChunks = $students->chunk($students->count() / $courses->count());

        $courses->each(function (Course $course) use ($studentsChunks) {

            $studentsChunks->each(function (Collection $studentsChunk) use ($course) {

                $studentsChunk->each(function (Student $student) use ($course) {

                    Enrollment::factory()->create([
                        'course_id' => $course->id,
                        'student_id' => $student->id,
                    ]);              
                });             
            });

            $studentsChunks->pop(1);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Enums\DaytimeEnum;
use App\Models\Classroom;
use App\Models\Curriculum;
use App\Models\Scopes\TeacherScope;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Collection */
        $teachers = Teacher::withoutGlobalScope(TeacherScope::class)->get();
        
        /** @var Collection */
        $curricula = Curriculum::get();

        $curriculaChunks = $curricula->chunk($curricula->count() / $teachers->count());

        $teachers->each(function (Teacher $teacher) use ($curriculaChunks) {

            $curriculaChunks->each(function (Collection $curriculaChunk) use ($teacher) {

                $curriculaChunk->each(function (Curriculum $curriculum) use ($teacher) {

                    Classroom::factory()->create([
                        'daytime' => DaytimeEnum::EVENING,
                        'teacher_id' => $teacher->id,
                        'curriculum_id' => $curriculum->id,
                    ]);
                });                
            });

            $curriculaChunks->pop(1);
        });
    }
}

<?php

namespace App\Observers;

use App\Events\Student\CreateStudent;
use App\Events\Student\DeleteStudent;
use App\Events\Student\UpdateStudent;
use App\Models\Student;
use Illuminate\Support\Facades\Event;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        Event::dispatch(new CreateStudent($student));
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        Event::dispatch(new UpdateStudent($student));
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        Event::dispatch(new DeleteStudent($student));
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Events\User\CreateUser;
use App\Events\User\DeleteUser;
use App\Events\User\UpdateUser;
use App\Models\User;
use Illuminate\Support\Facades\Event;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Event::dispatch(new CreateUser($user));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Event::dispatch(new UpdateUser($user));
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Event::dispatch(new DeleteUser($user));
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}

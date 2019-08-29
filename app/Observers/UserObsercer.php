<?php

namespace App\Observers;

use App\User;

class UserObsercer
{

    public function creating(User $user)
    {
        dd(32321);
    }

    public function created(User $user)
    {
        //
    }

    public function updated(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}

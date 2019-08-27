<?php

namespace App\Observers;

use App\Follow;
use App\Notifications\FollowUser;

class FollowObserver
{

    public function created(Follow $follow)
    {

        $followed = $follow->followed;
        if ($followed instanceof \App\User) {
            $followed->increment('count_follows');
            $followed->notify(new FollowUser($follow->user));
        }

    }

    public function updated(Follow $follow)
    {

    }

    public function deleted(Follow $follow)
    {

    }

    public function restored(Follow $follow)
    {
        $followed = $follow->followed;
        $followed->decrement('count_follows');
    }

    public function forceDeleted(Follow $follow)
    {

    }
}

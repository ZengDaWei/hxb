<?php

namespace App\Observers;

use App\Follow;

class FollowObserver
{

    public function created(Follow $follow)
    {
        $followed = $follow->followed;
        $followed->increment('count_follows');
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

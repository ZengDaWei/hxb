<?php

namespace App\Observers;

use App\Like;

class LikeObserver
{

    public function created(Like $like)
    {
        $liked = $like->liked;
        $liked->increment('count_likes');

    }

    public function updated(Like $like)
    {

    }

    public function deleted(Like $like)
    {
        $liked = $like->liked;
        $liked->decrement('count_likes');
    }

    public function restored(Like $like)
    {

    }

    public function forceDeleted(Like $like)
    {

    }
}

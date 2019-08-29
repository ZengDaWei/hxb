<?php

namespace App\Observers;

use App\Like;
use App\Notifications\LikeArticle;

class LikeObserver
{

    public function created(Like $like)
    {
        $liked = $like->liked;
        if ($liked instanceof \App\Article) {
            $liked->increment('count_likes');
            $liked->user->notify(new LikeArticle($like->user, $liked));
        }

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

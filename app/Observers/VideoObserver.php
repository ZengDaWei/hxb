<?php

namespace App\Observers;

use App\Video;

class VideoObserver
{

    public function created(Video $video)
    {
        $user = $video->user;
        $user->increment('count_videos');
    }

    public function updated(Video $video)
    {

    }

    public function deleted(Video $video)
    {
        $user = $video->user;
        $user->decrement('count_videos');
    }

    public function restored(Video $video)
    {

    }

    public function forceDeleted(Video $video)
    {

    }
}

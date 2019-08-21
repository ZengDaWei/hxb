<?php

namespace App\Observers;

use App\Reply;

class ReplyObserver
{

    public function created(Reply $reply)
    {
        $reply->comment->increment('count_replies');
    }

    public function updated(Reply $reply)
    {

    }

    public function deleted(Reply $reply)
    {
        $reply->comment->decrement('count_replies');
    }

    public function restored(Reply $reply)
    {

    }

    public function forceDeleted(Reply $reply)
    {

    }
}

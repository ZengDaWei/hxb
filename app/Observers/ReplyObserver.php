<?php

namespace App\Observers;

use App\Notifications\ReplyComment;
use App\Reply;

class ReplyObserver
{

    public function created(Reply $reply)
    {
        $user    = $reply->comment->user;
        $comment = $reply->comment;
        $comment->increment('count_replies');

        $user->notify(new ReplyComment($comment, $reply));
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

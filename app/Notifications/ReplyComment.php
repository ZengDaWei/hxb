<?php

namespace App\Notifications;

use App\Comment;
use App\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReplyComment extends Notification
{
    use Queueable;

    private $comment, $reply;

    public function __construct(Comment $comment, Reply $reply)
    {
        $this->comment = $comment;
        $this->reply   = $reply;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id'         => $this->reply->user->id,
            'user_name'       => $this->reply->user->name,
            'user_avatar'     => $this->reply->user->avatar,
            'reply_content'   => $this->reply->content,
            'comment_content' => $this->comment->content,
            'comment_id'      => $this->comment->id,
        ];
    }
}

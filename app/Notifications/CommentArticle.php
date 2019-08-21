<?php

namespace App\Notifications;

use App\Article;
use App\Comment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentArticle extends Notification
{
    use Queueable;

    private $article, $comment, $user;

    public function __construct(Article $article, Comment $comment, $user)
    {
        $this->article = $article;
        $this->comment = $comment;
        $this->user    = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id'         => $this->user->id,
            'user_name'       => $this->user->name,
            'user_avatar'     => $this->user->avatar,
            'comment_content' => $this->comment->content,
            'article_title'   => $this->article->title,
            'article_id'      => $this->article->id,
        ];
    }
}

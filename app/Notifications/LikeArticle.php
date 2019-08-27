<?php

namespace App\Notifications;

use App\Article;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LikeArticle extends Notification
{
    use Queueable;

    private $user, $article;

    public function __construct(User $user, Article $article)
    {
        $this->user    = $user;
        $this->article = $article;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id'       => $this->user->id,
            'user_name'     => $this->user->name,
            'user_avatar'   => $this->user->avatar,
            'article_title' => $this->article->title,
            'article_id'    => $this->article->id,
        ];
    }
}

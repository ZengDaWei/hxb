<?php

namespace App\Observers;

use App\Article;
use App\Comment;
use App\Notifications\CommentArticle;

class CommentObserver
{

    public function created(Comment $comment)
    {
        if ($comment->commentable instanceof Article) {
            $article = $comment->commentable;
            // 当数据不正常时，使用 comments->count()
            $article->increment('count_comments');
            $article->user->notify(new CommentArticle($article, $comment, $comment->user));
        }
    }

    public function updated(Comment $comment)
    {

    }

    public function deleted(Comment $comment)
    {
        if ($comment->commentable instanceof Article) {
            $article = $comment->commentable;
            // 当数据不正常时，使用 comments->count()
            $article->decrement('count_comments');
            $comment->replies()->delete();
        }
    }

    public function restored(Comment $comment)
    {

    }

    public function forceDeleted(Comment $comment)
    {

    }
}

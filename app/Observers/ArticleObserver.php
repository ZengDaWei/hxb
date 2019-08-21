<?php

namespace App\Observers;

use App\Article;

class ArticleObserver
{

    public function created(Article $article)
    {
        // update article
        $article->count_words = $article->getWords();
        $article->save();
        // update user
        $user = $article->user;
        $user->increment('count_articles');
        $user->increment('count_words', $article->count_words);

    }

    public function updated(Article $article)
    {
        //
    }

    public function deleted(Article $article)
    {
        // update user
        $user = $article->user;
        $user->decrement('count_articles');
        $user->decrement('count_words', $article->count_words);
        // delete comments and replies
        $article->comments()->each(function ($value, $key) use ($article) {
            $count = $value->replies()->count();
            if ($count > 0) {
                $value->replies()->delete();
            }
            $article->decrement('count_comments', $count);
            $value->delete();
        });
    }

    public function restored(Article $article)
    {
        //
    }

    public function forceDeleted(Article $article)
    {
        //
    }
}

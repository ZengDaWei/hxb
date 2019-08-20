<?php

namespace App\Observers;

use App\Article;

class ArticleObserver
{

    public function created(Article $article)
    {
        // update article
        $article->count_word = $article->getWords();
        $article->save();
        // update user
        $user = $article->user;
        $user->increment('count_articles');
        $user->increment('count_words', $article->count_word);
        // update comment
        $article->comments();
    }

    public function updated(Article $article)
    {
        //
    }

    public function deleted(Article $article)
    {
        //
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

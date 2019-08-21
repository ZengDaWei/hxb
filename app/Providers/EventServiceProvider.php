<?php

namespace App\Providers;

use App\Article;
use App\Comment;
use App\Observers\ArticleObserver;
use App\Observers\CommentObserver;
use App\Observers\ReplyObserver;
use App\Reply;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Article::observe(ArticleObserver::class);
        Comment::observe(CommentObserver::class);
        Reply::observe(ReplyObserver::class);
    }
}

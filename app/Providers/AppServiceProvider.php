<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        foreach (glob(app_path() . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
        foreach (glob(app_path() . '/Helpers/*/*.php') as $filename) {
            require_once $filename;
        }

        // laravel ide
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        Relation::morphMap([
            'users'        => 'App\User',
            'replies'      => 'App\Reply',
            'articles'     => 'App\Article',
            'comments'     => 'App\Comment',
            'likes'        => 'App\Like',
            'follows'      => 'App\Follow',
            'like_article' => 'App\Notifications\LikeArticle',
            'follow_user'  => 'App\Notifications\FollowUser',
        ]);
    }

    public function boot()
    {
        $this->registerSingleObject();
    }
    public function registerSingleObject()
    {
        // register ffmpeg and ffprobe
        $this->app->singleton('ffmpeg', function ($app) {
            return \FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => [
                    exec('which ffmpeg'),
                ],
                'ffprobe.binaries' => [
                    exec('which ffprobe'),
                ],
            ]);
        });
        $this->app->singleton('ffprobe', function ($app) {
            return \FFMpeg\FFProbe::create([
                'ffprobe.binaries' => [
                    exec('which ffprobe'),
                ],
            ]);
        });
    }
}

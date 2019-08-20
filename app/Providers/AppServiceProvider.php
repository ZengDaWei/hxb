<?php

namespace App\Providers;

use App\Helpers\QiniuAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 注册七牛云存储驱动
        Storage::extend('qiniu', function ($app, $config) {
            return new Filesystem(new QiniuAdapter('storage'));
        });
    }
}

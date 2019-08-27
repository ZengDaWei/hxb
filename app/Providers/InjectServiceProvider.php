<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InjectServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        // repo
        $this->app->bind(\App\Repositories\UserRepo::class);
        // service
        $this->app->bind(\App\Services\UserService::class, \App\Services\Implments\UserServiceImpl::class);
    }
}

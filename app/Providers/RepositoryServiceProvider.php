<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\PostRepository::class, \App\Repositories\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CelebrationRepository::class, \App\Repositories\CelebrationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CelebrationRepository2::class, \App\Repositories\CelebrationRepositoryEloquent2::class);
        $this->app->bind(\App\Repositories\CelebrationRepository2::class, \App\Repositories\CelebrationRepositoryEloquent3::class);

        //:end-bindings:
    }
}

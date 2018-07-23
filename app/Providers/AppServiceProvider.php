<?php

namespace App\Providers;

use App\Repositories\KyniemRepository;
use App\Repositories\KyniemReponsitoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KyniemRepository::Class,KyniemReponsitoryEloquent::Class);
        //
    }
}

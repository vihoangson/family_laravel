<?php

namespace App\Providers;

use App\Repositories\KyniemReponsitoryInterface;
use App\Repositories\KyniemRepository;
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
        $this->app->bind(KyniemReponsitoryInterface::class,KyniemRepository::class);

        //
    }
}

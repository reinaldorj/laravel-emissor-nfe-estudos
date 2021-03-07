<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Plan;
//use App\Observers\PlanObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;


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
       // Plan::observe(PlanObserver::class);
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}

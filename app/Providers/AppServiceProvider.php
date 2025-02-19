<?php

namespace App\Providers;



use Illuminate\Support\ServiceProvider;
use Iluminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $listen = [
        // ...
        OrderDelivered::class => [
            NotifyOrderDelivered::class,
        ],
    ];

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
        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\VehicleRepository::class,
            \App\Repositories\VehicleRepositoryImpl::class
        );
        $this->app->bind(
            \App\Services\VehicleService::class,
            \App\Services\VehicleServiceImpl::class
        );

        $this->app->bind(
            \App\Repositories\TransactionRepository::class,
            \App\Repositories\TransactionRepositoryImpl::class
        );
        $this->app->bind(
            \App\Services\TransactionService::class,
            \App\Services\TransactionServiceImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\DashboardRepository;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->bind(          
           DashboardService::class,
           DashboardRepository::class,
           BaseRepository::class,
        );
    }
}

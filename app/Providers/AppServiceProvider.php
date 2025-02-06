<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\ModuleServiceProvider;
use App\Providers\ConfigServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ModuleServiceProvider::class);
        $this->app->register(ConfigServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

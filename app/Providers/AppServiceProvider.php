<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\Observers\WebsiteObserver;
use App\Models\User;
use App\Models\Website;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Fix for utf8mb migration @https://laravel.com/docs/master/migrations#creating-indexes
        Schema::defaultStringLength(191);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('settings.force_https')) {
            \URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        User::observe(UserObserver::class);
        Website::observe(WebsiteObserver::class);
    }
}

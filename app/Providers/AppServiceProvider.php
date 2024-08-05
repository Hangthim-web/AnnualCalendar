<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if ($this->app->environment('production')) {
            URL::forceScheme('https');

                $this->app['url']->forceRootUrl(config('app.url'));
    URL::forceRootUrl(config('app.url'));
    URL::forceRootUrl(rtrim(config('app.url'), '/') . '/modules');
        }
            // Force URL path to include /site
    // $this->app['url']->forceRootUrl(config('app.url'));
    // URL::forceRootUrl(config('app.url'));
    // URL::forceRootUrl(rtrim(config('app.url'), '/') . '/modules');

    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**cccc
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
        $this->app['request']->server->set('HTTPS','on'); // this line



        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}

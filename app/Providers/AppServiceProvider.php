<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        \Carbon\Carbon::setLocale(config('app.locale'));
 // <<< NOSSO CÓDIGO NOVO - ADICIONE ABAIXO DELE >>>
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

<?php

namespace App\Providers;

use App\ApiClients\HttpClient;
use App\Services\WeatherService;
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
        $this->app->bind(WeatherService::class, function () {
            return new WeatherService(new HttpClient(), config('services.weather'));
        });
    }
}

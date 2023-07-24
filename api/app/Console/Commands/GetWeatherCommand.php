<?php

namespace App\Console\Commands;

use App\Services\WeatherService;
use Illuminate\Console\Command;

class GetWeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get weather data for all users';

    /**
     * Execute the console command.
     */
    public function handle(WeatherService $weatherService): void
    {
        $weatherService->loadCall();
    }
}

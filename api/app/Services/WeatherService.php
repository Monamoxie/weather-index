<?php

namespace App\Services;

use App\ApiClients\HttpClient;
use App\Contracts\ClientInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class WeatherService 
{
    protected $apiClient = null;
    
    protected $weatherConfig = [];

    public function __construct(ClientInterface $httpClient, $weatherConfig) 
    {
        $this->apiClient = $httpClient;
        $this->weatherConfig = $weatherConfig;
    }

    public function loadCall(): void
    {
        User::all()->each(function ($user) {
            $url = $this->getUrl($user);
            $data = $this->apiClient->get($url);

            if (is_array($data) && array_key_exists('error', $data)) {
                // log error 
                $this->logErrorhandler($data['error']['message'], $url, $data);
                return;
            }

           $this->persist($user, $data);
        });
    }

    protected function persist(User $user, array $data): void
    {
        $weather = $user->weather()->firstOrNew();
        $weather->temp_celsius = $data['current']['temp_c'];
        $weather->temp_fahrenheit = $data['current']['temp_f'];
        $weather->condition_text = $data['current']['condition']['text'];
        $weather->condition_icon = $data['current']['condition']['icon'];
        $weather->humidity = $data['current']['humidity'];
        $weather->location_name = $data['location']['name'];
        $weather->location_region = $data['location']['region'];
        $weather->location_country = $data['location']['country'];
        $weather->location_timezone = $data['location']['tz_id'];
        $weather->wind_mph = $data['current']['wind_mph'];
        $weather->wind_kph = $data['current']['wind_kph'];
        $weather->wind_dir = $data['current']['wind_dir'];
        $weather->wind_degree = $data['current']['wind_degree'];
        $weather->pressure_mb = $data['current']['pressure_mb'];
        $weather->pressure_in = $data['current']['pressure_in'];
        $weather->precip_mm = $data['current']['precip_mm'];
        $weather->precip_in = $data['current']['precip_in'];
        $weather->source_last_updated = $data['current']['last_updated'];
    
        $weather->save();
    }

    protected function getUrl(User $user): string
    {
        $params = [
            'key' => $this->weatherConfig['api_key'],
            'q' => $user->latitude . ',' . $user->longitude
        ];
        
        return $this->weatherConfig['base_url'] . '?' . http_build_query($params);
    }

    protected function logErrorHandler(string $message, string $url, array $data): void
    {
        Log::info($message, [$url, $data]);
    }
}
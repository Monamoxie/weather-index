<?php

namespace App\ApiClients;

use App\Contracts\ClientInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class HttpClient implements ClientInterface
{
    public function get(string $url): ?Array
    {
        try {
            $response =  $response = Http::get($url);

            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => [
                    'message' => $e->getMessage()
                ]
            ];
        }
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class HttpService
{
    /**
     * Performs a GET request and returns the JSON.
     *
     * @param string $url
     * @param array $params
     * @return array
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function get(string $url, array $params = []): array
    {
        try {
            $response = Http::get($url, $params);

            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            throw $e;
        }
    }
}

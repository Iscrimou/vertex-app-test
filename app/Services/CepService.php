<?php

namespace App\Services;

use App\Services\HttpService;
use Illuminate\Http\Client\RequestException;

class CepService
{
    protected HttpService $httpService;

    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
    }

    /**
     * Query data for a ZIP code using the ViaCEP API.
     *
     * @param string $cep
     * @return array
     *
     * @throws RequestException
     */
    public function checkCep(string $cep): array
    {
        $url = env("VIACEP_URL", "https://viacep.com.br/ws/") . "{$cep}/json";

        $response = $this->httpService->get($url);

        if (isset($response['erro'])) {
            return [];
        }

        return $response;
    }
}

<?php

namespace App\Service;

use GuzzleHttp\Exception\GuzzleException;

class JsonPlaceholderApi
{
    /**
     * @var string
     */
    private $baseUri = 'https://swapi.dev';

    public const URL_PARAMETER = '/api/planets/';

    /**
     * @param $route
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function getByParameters($route, array $params = []): array
    {
        return (new JsonPlaceholderApiClient($this->baseUri))->getByParameters($route, $params);
    }
}
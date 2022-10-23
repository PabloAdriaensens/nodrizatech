<?php

namespace App\Application\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JsonPlaceholderApiClient
{
    /**
     * @var Client
     */
    private $_client;

    /**
     * @param $baseUri
     */
    public function __construct($baseUri)
    {
        $this->_client = new Client(
            [
                // Base URI is used with relative requests
                'base_uri' => $baseUri,
                // Timeout if a server does not return a response
                'timeout' => 2.0,
            ]
        );
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function getByParameters($endpoint, array $params = []): array
    {
        try {
            $response = $this->_client->request(
                'GET',
                $endpoint,
                [
                    'query' => $params,
                ]
            );
            $response->getHeaderLine('application/json');

            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            return [];
        }
    }
}
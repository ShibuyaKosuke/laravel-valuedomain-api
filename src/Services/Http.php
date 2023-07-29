<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Config\Repository;
use Illuminate\Support\Arr;

class Http
{
    public const API_URL = 'https://api.value-domain.com/v1/';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $apiKey;

    /**
     * @param Client $client
     * @param Repository $repository
     */
    public function __construct(Client $client, Repository $repository)
    {
        $this->client = $client;
        $this->apiKey = $repository->get('valuedomain.api_key');
    }

    /**
     * @return string
     */
    public function setHeaderAuthorization(): string
    {
        return 'Bearer ' . $this->apiKey;
    }

    /**
     * @return string
     */
    public function setHeaderAccept(): string
    {
        return 'application/json';
    }

    /**
     * @return string
     */
    public function setHeaderContentType(): string
    {
        return 'application/x-www-form-urlencoded';
    }

    /**
     * @param string $endpoint
     * @return array
     * @throws GuzzleException
     */
    public function getAll(string $endpoint): array
    {
        $results = [];
        $currentPage = 1;

        do {
            $response = $this->get($endpoint, ['page' => $currentPage]);
            $results += Arr::get($response, 'results', []);
            $currentPage++;
        } while ($currentPage <= Arr::get($response, 'paging.page'));

        return $results;
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function get(string $endpoint, array $params = []): array
    {
        $url = self::API_URL . $endpoint;
        if (count($params)) {
            $url .= '?' . http_build_query($params);
        }

        $response = $this->client->get($url, [
            'headers' => [
                'Authorization' => $this->setHeaderAuthorization(),
                'Accept' => $this->setHeaderAccept(),
            ],
            'timeout' => 120,
            'verify' => true,
        ]);

        $body = $response->getBody();
        return json_decode($body, true, 512);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $data = []): array
    {
        $url = self::API_URL . $endpoint;

        $response = $this->client->post($url, [
            'headers' => [
                'Authorization' => $this->setHeaderAuthorization(),
                'Accept' => $this->setHeaderAccept(),
                'Content-Type' => $this->setHeaderContentType()
            ],
            'timeout' => 120,
            'verify' => true,
            'form_params' => $data
        ]);

        $body = $response->getBody();
        return json_decode($body, true, 512);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function put(string $endpoint, array $data = []): array
    {
        $url = self::API_URL . $endpoint;

        $response = $this->client->put($url, [
            'headers' => [
                'Authorization' => $this->setHeaderAuthorization(),
                'Accept' => $this->setHeaderAccept(),
                'Content-Type' => $this->setHeaderContentType()
            ],
            'timeout' => 120,
            'verify' => true,
            'form_params' => $data
        ]);

        $body = $response->getBody();
        return json_decode($body, true, 512);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $endpoint, array $data = []): array
    {
        $url = self::API_URL . $endpoint;

        $response = $this->client->delete($url, [
            'headers' => [
                'Authorization' => $this->setHeaderAuthorization(),
                'Accept' => $this->setHeaderAccept(),
                'Content-Type' => $this->setHeaderContentType()
            ],
            'timeout' => 120,
            'verify' => true,
            'form_params' => $data
        ]);

        $body = $response->getBody();
        return json_decode($body, true, 512);
    }
}

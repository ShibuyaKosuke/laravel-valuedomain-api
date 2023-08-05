<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Config\Repository;
use Illuminate\Support\Arr;

class Http
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $apiKey;

    /**
     * @var string
     */
    private string $base_url;

    /**
     * @param Client $client
     * @param Repository $repository
     */
    public function __construct(Client $client, Repository $repository)
    {
        $this->client = $client;
        $this->apiKey = $repository->get('valuedomain.api_key');
        $this->base_url = $repository->get('valuedomain.base_url');
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

            /** @noinspection SlowArrayOperationsInLoopInspection */
            $results = array_merge($results, $response['results'], []);
            $currentPage++;

            $max = Arr::get($response, 'paging.max');
            $limit = Arr::get($response, 'paging.limit');
            $total = ceil($max / $limit);
        } while ($currentPage <= $total);

        return $results;
    }

    /**
     * @param string $endpoint
     * @return string
     */
    private function getUrl(string $endpoint): string
    {
        return collect()
            ->push($this->base_url)
            ->push($endpoint)
            ->map(function ($item) {
                return trim($item, '/');
            })
            ->implode('/');
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function get(string $endpoint, array $params = []): array
    {
        $url = $this->getUrl($endpoint);
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
        $response = $this->client->post($this->getUrl($endpoint), [
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
        $response = $this->client->put($this->getUrl($endpoint), [
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
        $response = $this->client->delete($this->getUrl($endpoint), [
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

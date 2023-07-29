<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Services;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;

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
     * @param string $endpoint
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $endpoint, array $params = [])
    {
        $url = self::API_URL . $endpoint;
        if (count($params)) {
            $url .= '?' . http_build_query($params);
        }

        $response = $this->client->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
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
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(string $endpoint, array $data = [])
    {
        $url = self::API_URL . $endpoint;

        $post_query = json_encode($data);

        $response = $this->client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ],
            'timeout' => 120,
            'verify' => true,
            'body' => $post_query
        ]);

        $body = $response->getBody();
        return json_decode($body, true, 512);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put(string $endpoint, array $data = [])
    {
        $url = self::API_URL . $endpoint;

        $post_query = json_encode($data);

        $response = $this->client->put($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ],
            'timeout' => 120,
            'verify' => true,
            'body' => $post_query
        ]);

        $body = $response->getBody();
        return json_decode($body, true, 512);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $endpoint, array $data = [])
    {
        $url = self::API_URL . $endpoint;

        $post_query = json_encode($data);

        $response = $this->client->delete($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ],
            'timeout' => 120,
            'verify' => true,
            'body' => $post_query
        ]);

        $body = $response->getBody();
        return json_decode($body, true, 512);
    }
}

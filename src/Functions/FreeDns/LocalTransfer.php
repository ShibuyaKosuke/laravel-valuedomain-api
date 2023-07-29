<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\FreeDns;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class LocalTransfer extends Base
{
    /**
     * @return array
     * @throws GuzzleException
     */
    public function all(): array
    {
        $results = [];
        $currentPage = 1;

        do {
            $response = $this->http->get("freedns/localtransfer", ['page' => $currentPage]);
            $results += Arr::get($response, 'results', []);
            $currentPage++;
        } while ($currentPage <= Arr::get($response, 'paging.page'));

        return $results;
    }

    /**
     * @param string $domain
     * @return array
     * @throws GuzzleException
     */
    public function get(string $domain): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->get("freedns/{$domain}/localtransfer");
    }

    /**
     * @param string $domain
     * @param string $username
     * @param string $message
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain, string $username, string $message): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("freedns/{$domain}/localtransfer", [
            'username' => $username,
            'message' => $message,
        ]);
    }
}

<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class DynamicDns extends Base
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
            $response = $this->http->get("domains/dynamicdns", ['page' => $currentPage]);
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
    public function get(string $domain = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->get("domains/{$domain}/dynamicdns");
    }

    /**
     * @param string|null $domain
     * @param integer $dynamicdns
     * @param string $password
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain = null, int $dynamicdns = 0, string $password = ''): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("domains/{$domain}/dynamicdns", [
            'dynamicdns' => $dynamicdns,
            'password' => $password,
        ]);
    }
}

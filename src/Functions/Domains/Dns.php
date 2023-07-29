<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;
use ShibuyaKosuke\LaravelValuedomainApi\Services\Http;

class Dns extends Base
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
            $response = $this->http->get("domains/dns", ['page' => $currentPage]);
            $results += Arr::get($response, 'results', []);
            $currentPage++;
        } while ($currentPage <= Arr::get($response, 'paging.page'));

        return $results;
    }

    /**
     * @param string|null $domain
     * @return array
     * @throws GuzzleException
     */
    public function get(string $domain = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->get("domains/{$domain}/dns");
    }

    /**
     * @param string|null $domain
     * @param string $records
     * @param integer $ttl
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain = null, string $records = '', int $ttl = 1200): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("domains/{$domain}/dns", [
            'ns_type' => 'valuedomain1',
            'records' => $records,
            'ttl' => $ttl,
        ]);
    }
}

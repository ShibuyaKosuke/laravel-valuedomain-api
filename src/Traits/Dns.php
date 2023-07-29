<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Traits;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;

trait Dns
{
    /**
     * @return array
     * @throws GuzzleException
     */
    public function getDnses(): array
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
    public function getDns(string $domain = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->get("domains/{$domain}/dns");
    }

    /**
     * @param string $domain
     * @param string $records
     * @param integer $ttl
     * @return mixed
     * @throws GuzzleException
     */
    public function updateDns(string $domain, string $records, int $ttl = 1200): mixed
    {
        return $this->http->put("domains/{$domain}/dns", [
            'domain' => $domain,
            'records' => $records,
            'ttl' => $ttl,
        ]);
    }
}

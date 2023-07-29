<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Traits;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;

trait Domains
{
    /**
     * @return array
     * @throws GuzzleException
     */
    public function getDomains(): array
    {
        $results = [];
        $currentPage = 1;

        do {
            $response = $this->http->get("domains", ['page' => $currentPage]);
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
    public function getDomain(string $domain = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->get("domains/{$domain}");
    }
}

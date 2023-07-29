<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class Nameserver extends Base
{
    /**
     * @return array
     * @throws GuzzleException
     */
    public function all()
    {
        $results = [];
        $currentPage = 1;

        do {
            $response = $this->http->get("domains/nameserver", ['page' => $currentPage]);
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
        return $this->http->get("domains/{$domain}/nameserver");
    }

    /**
     * @param string|null $domain
     * @param string|null $ns
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain = null, string $ns = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("domains/{$domain}/nameserver", [
            'ns' => $ns,
        ]);
    }
}

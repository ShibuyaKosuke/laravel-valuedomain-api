<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;
use ShibuyaKosuke\LaravelValuedomainApi\Services\Http;

class Expiration extends Base
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
            $response = $this->http->get("domains/expiration", ['page' => $currentPage]);
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
        return $this->http->get("domains/{$domain}/expiration");
    }

    /**
     * @param string|null $domain
     * @param integer $years
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain = null, int $years = 1): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        $data = [
            'years' => $years
        ];
        return $this->http->put("domains/{$domain}/expiration", $data);
    }
}

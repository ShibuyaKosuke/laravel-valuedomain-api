<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class AutoRenew extends Base
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
            $response = $this->http->get("domains/autorenew", ['page' => $currentPage]);
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
        return $this->http->get("domains/{$domain}/autorenew");
    }

    /**
     * @param string|null $domain
     * @param integer $autorenew_all
     * @param integer $autorenew_domain
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain = null, int $autorenew_all = 0, int $autorenew_domain = 0): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("domains/{$domain}/autorenew", [
            'autorenew_all' => $autorenew_all,
            'autorenew_domain' => $autorenew_domain,
        ]);
    }
}

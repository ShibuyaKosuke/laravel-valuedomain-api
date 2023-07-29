<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class Transfer extends Base
{
    /**
     * @return array|\ArrayAccess|mixed
     * @throws GuzzleException
     */
    public function all()
    {
        $results = [];
        $currentPage = 1;

        do {
            $response = $this->http->get("domains/transfer", ['page' => $currentPage]);
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
        return $this->http->get("domains/{$domain}/transfer");
    }

    /**
     * @param string $domain
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function create(string $domain, array $data = []): array
    {
        return $this->http->post("domains/{$domain}/transfer", $data);
    }

    /**
     * @param string $domain
     * @param string $transferorderid
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain, string $transferorderid): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->get("domains/{$domain}/transfer/{$transferorderid}");
    }

    /**
     * @param string $domain
     * @param string $transferorderid
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $domain, string $transferorderid): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->delete("domains/{$domain}/transfer/{$transferorderid}");
    }
}

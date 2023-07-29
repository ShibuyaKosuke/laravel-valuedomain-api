<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class Whois extends Base
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
            $response = $this->http->get("domains/whois", ['page' => $currentPage]);
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
        return $this->http->get("domains/{$domain}/whois");
    }

    /**
     * @param string $domain
     * @param integer $whois_proxy
     * @param object $contact
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain, int $whois_proxy, object $contact): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("domains/{$domain}/whois", [
            'whois_proxy' => $whois_proxy,
            'contact' => $contact,
        ]);
    }
}

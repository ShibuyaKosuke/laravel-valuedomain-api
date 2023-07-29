<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class TransferLock extends Base
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
            $response = $this->http->get("domains/transferlock", ['page' => $currentPage]);
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
        return $this->http->get("domains/{$domain}/transferlock");
    }

    /**
     * @param string $domain
     * @param integer $transfer_lock
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain, int $transfer_lock): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("domains/{$domain}/transferlock", [
            'transfer_lock' => $transfer_lock,
        ]);
    }
}

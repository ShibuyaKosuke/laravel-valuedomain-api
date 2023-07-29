<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions;

use GuzzleHttp\Exception\GuzzleException;

class FreeDns extends Base
{
    /**
     * @return array
     * @throws GuzzleException
     */
    public function all(): array
    {
        return $this->http->getAll("freedns");
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
        return $this->http->get("freedns/{$domain}");
    }

    /**
     * @param string $sld
     * @param string $tld
     * @param string $auth
     * @return array
     * @throws GuzzleException
     */
    public function create(string $sld, string $tld, string $auth): array
    {
        return $this->http->post("freedns", [
            'sld' => $sld,
            'tld' => $tld,
            'auth' => $auth,
        ]);
    }

    /**
     * @param string|null $domain
     * @param string|null $records
     * @param integer $ttl
     * @return array
     * @throws GuzzleException
     */
    public function update(string $domain = null, string $records = null, int $ttl = 1200): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->put("freedns/{$domain}", [
            'records' => $records,
            'ttl' => $ttl,
        ]);
    }

    /**
     * @param string|null $domain
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $domain = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->delete("domains/{$domain}");
    }
}

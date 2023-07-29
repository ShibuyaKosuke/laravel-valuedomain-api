<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions;

use GuzzleHttp\Exception\GuzzleException;
use ShibuyaKosuke\LaravelValuedomainApi\Services\Http;

class Domain extends Base
{
    /**
     * @return array
     * @throws GuzzleException
     */
    public function all(): array
    {
        return $this->http->getAll("domains");
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
        return $this->http->get("domains/{$domain}");
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

<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains;

use GuzzleHttp\Exception\GuzzleException;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Base;

class PrivateNameServer extends Base
{
    /**
     * @param string $domain
     * @return array
     * @throws GuzzleException
     */
    public function all(string $domain): array
    {
        return $this->http->getAll("domains/{$domain}/privatenameserver");
    }

    /**
     * @param string $domain
     * @param string $hostname
     * @param string|null $ipv4
     * @param string|null $ipv6
     * @return array
     * @throws GuzzleException
     */
    public function create(string $domain, string $hostname, string $ipv4 = null, string $ipv6 = null): array
    {
        return $this->http->post("domains/{$domain}/privatenameserver", [
            'hostname' => $hostname,
            'ipv4' => $ipv4,
            'ipv6' => $ipv6,
        ]);
    }

    /**
     * @param string|null $domain
     * @param string|null $hostname
     * @return array
     * @throws GuzzleException
     */
    public function get(string $domain = null, string $hostname = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->get("domains/{$domain}/privatenameserver/{$hostname}");
    }

    /**
     * @param string|null $domain
     * @param string|null $hostname
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $domain = null, string $hostname = null): array
    {
        if (is_null($domain)) {
            $domain = $this->domain;
        }
        return $this->http->delete("domains/{$domain}/privatenameserver/{$hostname}");
    }
}

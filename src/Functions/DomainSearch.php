<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions;

use GuzzleHttp\Exception\GuzzleException;

class DomainSearch extends Base
{
    /**
     * @param array $domainNames
     * @return array
     * @throws GuzzleException
     */
    public function get(array $domainNames = []): array
    {
        return $this->http->get("domainsearch", ['domainnames' => implode(',', $domainNames)]);
    }
}

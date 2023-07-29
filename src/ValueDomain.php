<?php

namespace ShibuyaKosuke\LaravelValuedomainApi;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use ShibuyaKosuke\LaravelValuedomainApi\Traits\Dns;
use ShibuyaKosuke\LaravelValuedomainApi\Traits\Domains;
use ShibuyaKosuke\LaravelValuedomainApi\Traits\Expiration;

class ValueDomain
{
    use Domains;
    use Expiration;
    use Dns;

    /**
     * @var Services\Http $http
     */
    private Services\Http $http;

    /**
     * @var string $domain
     */
    private string $domain;

    /**
     * @param Repository $config
     * @param Client $client
     */
    public function __construct(Repository $config, Client $client)
    {
        $this->http = new Services\Http($client, $config);
        $this->domain = $config->get('app.host_name');
    }
}

<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions;

use ShibuyaKosuke\LaravelValuedomainApi\Services\Http;

abstract class Base
{
    /**
     * @var Http
     */
    protected Http $http;

    /**
     * @var string
     */
    protected string $domain;

    /**
     * @param Http $http
     * @param string $domain
     */
    public function __construct(Http $http, string $domain)
    {
        $this->http = $http;
        $this->domain = $domain;
    }
}

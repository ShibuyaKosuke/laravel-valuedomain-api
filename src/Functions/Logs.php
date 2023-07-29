<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Functions;

use GuzzleHttp\Exception\GuzzleException;

class Logs extends Base
{
    /**
     * @return array
     * @throws GuzzleException
     */
    public function all(): array
    {
        return $this->http->getAll("logs");
    }

    /**
     * @param string $request_id
     * @return array
     * @throws GuzzleException
     */
    public function get(string $request_id): array
    {
        return $this->http->get("logs/{$request_id}");
    }
}

<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Facades;

use Illuminate\Support\Facades\Facade;

class ValueDomain extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return \ShibuyaKosuke\LaravelValuedomainApi\ValueDomain::class;
    }
}

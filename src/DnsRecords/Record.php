<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\DnsRecords;

/**
 * Class Record
 * @package ShibuyaKosuke\LaravelValuedomainApi\DnsRecords
 * @property string $type
 * @property string $name
 * @property string $value
 */
class Record
{
    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return isset($this->{$name});
    }

    /**
     * @param string $name
     * @param string $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->type} {$this->name} {$this->value}";
    }
}

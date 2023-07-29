<?php

namespace ShibuyaKosuke\LaravelValuedomainApi;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\AutoRenew;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\Dns;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domain;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\DnsSec;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\DynamicDns;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\Expiration;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\LocalTransfer;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\Nameserver;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\PrivateNameServer;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\Transfer;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\TransferLock;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Domains\Whois;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\DomainSearch;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\FreeDns;
use ShibuyaKosuke\LaravelValuedomainApi\Functions\Logs;

class ValueDomain
{
    /**
     * @var Services\Http $http
     */
    private Services\Http $http;

    /**
     * @var string
     */
    private string $hostname;

    /**
     * @param Repository $config
     * @param Client $client
     */
    public function __construct(Repository $config, Client $client)
    {
        $this->http = new Services\Http($client, $config);
        $this->hostname = $config->get('app.host_name');
    }

    /**
     * ドメイン
     * @return Domain
     */
    public function domain(): Domain
    {
        return new Domain($this->http, $this->hostname);
    }

    /**
     * @return AutoRenew 自動更新
     */
    public function autoRenew(): AutoRenew
    {
        return new AutoRenew($this->http, $this->hostname);
    }

    /**
     * DNS設定
     * @return Dns
     */
    public function dns(): Dns
    {
        return new Dns($this->http, $this->hostname);
    }

    /**
     * @return DnsSec DNSSEC
     */
    public function dnsSec(): DnsSec
    {
        return new DnsSec($this->http, $this->hostname);
    }

    /**
     * @return DynamicDns ダイナミックDNS
     */
    public function dynamicDns(): DynamicDns
    {
        return new DynamicDns($this->http, $this->hostname);
    }

    /**
     * ドメインの期限
     * @return Expiration
     */
    public function expiration(): Expiration
    {
        return new Expiration($this->http, $this->hostname);
    }

    /**
     * @return LocalTransfer ローカル転送
     */
    public function localTransfer(): LocalTransfer
    {
        return new LocalTransfer($this->http, $this->hostname);
    }

    /**
     * @return Nameserver ネームサーバー
     */
    public function nameserver(): Nameserver
    {
        return new Nameserver($this->http, $this->hostname);
    }

    /**
     * @return PrivateNameServer プライベートネームサーバー
     */
    public function privateNameserver(): PrivateNameserver
    {
        return new PrivateNameServer($this->http, $this->hostname);
    }

    /**
     * @return Transfer 転送
     */
    public function transfer(): Transfer
    {
        return new Transfer($this->http, $this->hostname);
    }

    /**
     * @return TransferLock 転送ロック
     */
    public function transferLock(): TransferLock
    {
        return new TransferLock($this->http, $this->hostname);
    }

    /**
     * @return Whois Whois
     */
    public function whois(): Whois
    {
        return new Whois($this->http, $this->hostname);
    }

    /**
     * @return DomainSearch ドメイン検索
     */
    public function domainSearch(): DomainSearch
    {
        return new DomainSearch($this->http, $this->hostname);
    }

    /**
     * @return FreeDns フリーDNS
     */
    public function freeDns(): FreeDns
    {
        return new FreeDns($this->http, $this->hostname);
    }

    /**
     * @return FreeDns\LocalTransfer フリーDNSローカル転送
     */
    public function freeDnsLocalTransfer(): FreeDns\LocalTransfer
    {
        return new FreeDns\LocalTransfer($this->http, $this->hostname);
    }

    /**
     * @return Logs ログ
     */
    public function logs(): Logs
    {
        return new Logs($this->http, $this->hostname);
    }
}

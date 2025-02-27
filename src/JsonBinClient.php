<?php

declare(strict_types=1);

namespace JsonBinSDK;

use JsonBinSDK\Api\AccessKeyApi;
use JsonBinSDK\Api\BinApi;
use JsonBinSDK\Api\CollectionApi;
use JsonBinSDK\Api\LogApi;
use JsonBinSDK\Config\Configuration;
use JsonBinSDK\HttpClient\GuzzleClient;

readonly class JsonBinClient
{
    private Configuration $config;
    private BinApi $binApi;
    private CollectionApi $collectionApi;
    private AccessKeyApi $accessKeyApi;
    private LogApi $logApi;

    public function __construct(string $apiKey)
    {
        $this->setConfig(new Configuration($apiKey));
        $httpClient = new GuzzleClient($this->getConfig());

        $this->binApi = new BinApi($httpClient);
        $this->collectionApi = new CollectionApi($httpClient);
        $this->accessKeyApi = new AccessKeyApi($httpClient);
        $this->logApi = new LogApi($httpClient);
    }

    public function getConfig(): Configuration
    {
        return $this->config;
    }

    public function setConfig(Configuration $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function bins(): BinApi
    {
        return $this->binApi;
    }

    public function collections(): CollectionApi
    {
        return $this->collectionApi;
    }

    public function accessKey(): AccessKeyApi
    {
        return $this->accessKeyApi;
    }

    public function log(): LogApi
    {
        return $this->logApi;
    }
}
<?php

declare(strict_types=1);

namespace JsonBinSDK\Config;

class Configuration
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $baseUrl = 'https://api.jsonbin.io',
        private int $timeout = 30
    ) {
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }
    
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }
}
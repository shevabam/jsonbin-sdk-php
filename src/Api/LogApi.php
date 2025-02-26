<?php

declare(strict_types=1);

namespace JsonBinSDK\Api;

use JsonBinSDK\HttpClient\ClientInterface;

class LogApi
{
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * List all logs
     */
    public function list(): array
    {
        return $this->client->get("/v3/l");
    }
}
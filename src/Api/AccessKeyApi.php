<?php

declare(strict_types=1);

namespace JsonBinSDK\Api;

use JsonBinSDK\HttpClient\ClientInterface;

readonly class AccessKeyApi
{
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * Create an access key
     */
    public function create(string $name, array $options = []): array
    {
        $header = ['X-Key-Name' => $name];
        
        $rights = [];
        $rights['read'] = isset($options['read']) && true === $options['read'] ?: false;
        $rights['update'] = isset($options['update']) && true === $options['update'] ?: false;
        $rights['delete'] = isset($options['delete']) && true === $options['delete'] ?: false;
        $rights['create'] = isset($options['create']) && true === $options['create'] ?: false;

        $payload = ['bins' => $rights];

        return $this->client->post('/v3/a', $payload, array_merge($header, $options));
    }

    /**
     * Delete access key
     */
    public function delete(string $accessKey): array
    {
        return $this->client->delete("/v3/a/{$accessKey}");
    }

    /**
     * List all access keys
     */
    public function list(): array
    {
        return $this->client->get("/v3/a");
    }
}
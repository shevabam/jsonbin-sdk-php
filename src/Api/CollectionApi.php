<?php

declare(strict_types=1);

namespace JsonBinSDK\Api;

use JsonBinSDK\HttpClient\ClientInterface;

class CollectionApi
{
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * Crée une nouvelle collection
     */
    public function create(string $name, array $options = []): array
    {
        $header = ['X-Collection-Name' => $name];

        return $this->client->post('/v3/c', [], array_merge($header, $options));
    }

    /**
     * Récupère les détails d'une collection
     */
    public function read(string $collectionId): array
    {
        return $this->client->get("/v3/c/{$collectionId}");
    }

    /**
     * Met à jour une collection
     */
    public function update(string $collectionId, string $name): array
    {
        $header = ['X-Collection-Name' => $name];

        return $this->client->put("/v3/c/{$collectionId}/meta/name", [], $header);
    }

    /**
     * Supprime une collection
     */
    public function delete(string $collectionId): array
    {
        return $this->client->delete("/v3/c/{$collectionId}");
    }

    /**
     * Liste tous les bins dans une collection
     */
    public function listBins(string $collectionId): array
    {
        return $this->client->get("/v3/c/{$collectionId}/bins");
    }

    /**
     * Liste tous les bins sans collection
     */
    public function listUncategorizedBins(): array
    {
        return $this->client->get("/v3/c/uncategorized/bins");
    }
}
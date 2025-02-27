<?php

declare(strict_types=1);

namespace JsonBinSDK\Api;

use JsonBinSDK\HttpClient\ClientInterface;

readonly class BinApi
{
    private const HEADER_PRIVATE = 'X-Bin-Private';
    private const HEADER_NAME = 'X-Bin-Name';
    private const HEADER_COLLECTION_ID = 'X-Collection-Id';

    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * Crée un nouveau bin
     *
     * @param array $data Les données à stocker dans le bin
     * @param array $options Options du bin avec les clés possibles :
     *                      - private: bool - Si le bin doit être privé
     *                      - name: string - Nom du bin
     *                      - collectionId: string - ID de la collection à laquelle ajouter ce bin
     */
    public function create(array $data, array $options = []): array
    {
        $headers = $this->prepareHeaders($options);
        return $this->client->post('/v3/b', $data, $headers);
    }

    public function read(string $binId): array
    {
        return $this->client->get("/v3/b/{$binId}");
    }

    public function update(string $binId, array $data, array $options = []): array
    {
        $headers = $this->prepareHeaders($options);
        return $this->client->put("/v3/b/{$binId}", $data, $headers);
    }

    public function delete(string $binId): array
    {
        return $this->client->delete("/v3/b/{$binId}");
    }

    /**
     * Convertit les options utilisateur en headers HTTP pour l'API
     */
    private function prepareHeaders(array $options): array
    {
        $headers = [];

        if (isset($options['private'])) {
            $headers[self::HEADER_PRIVATE] = $options['private'] ? 'true' : 'false';
        }

        if (isset($options['name'])) {
            $headers[self::HEADER_NAME] = $options['name'];
        }

        if (isset($options['collectionId'])) {
            $headers[self::HEADER_COLLECTION_ID] = $options['collectionId'];
        }

        return $headers;
    }
}
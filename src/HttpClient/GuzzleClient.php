<?php

declare(strict_types=1);

namespace JsonBinSDK\HttpClient;

use GuzzleHttp\Client as GuzzleHttpClient;
use JsonBinSDK\Config\Configuration;
use JsonBinSDK\Exception\ApiException;
use Psr\Http\Client\ClientExceptionInterface;

class GuzzleClient implements ClientInterface
{
    private GuzzleHttpClient $client;
    private array $defaultHeaders;

    public function __construct(private readonly Configuration $config)
    {
        $this->client = new GuzzleHttpClient([
            'base_uri' => $config->getBaseUrl(),
            'timeout' => $config->getTimeout(),
            // 'verify' => false,
        ]);

        $this->defaultHeaders = [
            'X-Master-Key' => $config->getApiKey(),
            'Content-Type' => 'application/json',
        ];
    }

    public function get(string $endpoint, array $headers = []): array
    {
        return $this->request('GET', $endpoint, [], $headers);
    }

    public function post(string $endpoint, array $data, array $headers = []): array
    {
        return $this->request('POST', $endpoint, $data, $headers);
    }

    public function put(string $endpoint, array $data, array $headers = []): array
    {
        return $this->request('PUT', $endpoint, $data, $headers);
    }

    public function delete(string $endpoint, array $headers = []): array
    {
        return $this->request('DELETE', $endpoint, [], $headers);
    }

    private function request(string $method, string $endpoint, array $data = [], array $headers = []): array
    {
        try {
            $response = $this->client->request($method, $endpoint, [
                'headers' => array_merge($this->defaultHeaders, $headers),
                'json' => $data,
            ]);

            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (ClientExceptionInterface $clientException) {
            throw new ApiException($clientException->getMessage(), $clientException->getCode(), $clientException);
        } catch (\JsonException $jsonException) {
            throw new ApiException('Failed to decode JSON response', 0, $jsonException);
        }
    }
}
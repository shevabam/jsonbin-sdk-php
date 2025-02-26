<?php

declare(strict_types=1);

namespace JsonBinSDK\HttpClient;

interface ClientInterface
{
    public function get(string $endpoint, array $headers = []): array;
    public function post(string $endpoint, array $data, array $headers = []): array;
    public function put(string $endpoint, array $data, array $headers = []): array;
    public function delete(string $endpoint, array $headers = []): array;
}
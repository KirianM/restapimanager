<?php

namespace KMurgadella\RestApiManager;

interface ApiManagerInterface
{
    public function __construct(string $apiUrl);

    public function getApiUrl(): string;

    public function setApiUrl(string $apiUrl);

    public function get(string $url, array $headers = []);

    public function put(string $url, array $data, array $headers = []);

    public function post(string $url, array $data, array $headers = []);

    public function request(string $method, string $url, array $data, array $headers);

    public function authHeaders(array $headers = []): array;
}

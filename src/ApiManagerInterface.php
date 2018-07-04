<?php

namespace KMurgadella\RestApiManager;

use KMurgadella\RestApiManager\Auth\Manager\ManagerInterface;

interface ApiManagerInterface
{
    public function __construct(string $apiUrl);

    public function getApiUrl(): string;

    public function setApiUrl(string $apiUrl);

    public function get(string $url, array $headers = []);

    public function put(string $url, array $data, array $headers = []): array;

    public function post(string $url, array $data, array $headers = []): array;

    public function request(string $method, string $url, array $data, array $headers): array;

    public function authHeaders(array $headers = []): array;

    public function getAuth(): ManagerInterface;

    public function setAuth(ManagerInterface $auth);
}

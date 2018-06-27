<?php

namespace KMurgadella\RestApiManager;

interface ApiManagerInterface
{
    public function __construct(string $apiUrl);

    public function setApiUrl(string $apiUrl);

    public function connect();

    public function get(string $url);

    public function put(string $url, array $data);

    public function post(string $url, array $data);

    public function request(string $method, string $url, array $data, array $headers);
}

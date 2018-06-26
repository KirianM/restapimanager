<?php

namespace KMurgadella\RestApiManager;

interface ApiManagerInterface
{
    function __construct(string $apiUrl);

    public function setApiUrl(string $apiUrl);

    protected function connect();

    public function get(string $url);

    public function put(string $url, array $data);

    public function post(string $url, array $data);

    protected function request(string $method, string $url, array $data, array $headers);
}

<?php

namespace KMurgadella\RestApiManager;

use KMurgadella\RestApiManager\Auth\Manager\ManagerInterface;
use KMurgadella\RestApiManager\Exception\RequestException;
use KMurgadella\RestApiManager\Exception\RequestResponseFormatException;

class ApiManager implements ApiManagerInterface
{
    protected $apiUrl;
    protected $auth;

    function __construct(string $apiUrl = null)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function setAuth(ManagerInterface $auth)
    {
        $this->auth = $auth;
    }

    public function setApiUrl(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function get(string $url, array $headers = [])
    {
        return $this->request('GET', $url, $headers);
    }

    public function put(string $url, array $data, array $headers = [])
    {
        return $this->request('PUT', $url, $data, $headers);
    }

    public function post(string $url, array $data, array $headers = [])
    {
        return $this->request('POST', $url, $data, $headers);
    }

    public function request(string $method, string $url, array $data = [], array $headers = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $url);

        if (in_array($method, ['POST', 'PUT'])) {
            curl_setopt($ch, CURLOPT_POST, 1);
            if (!empty($data)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        try {
            $response = curl_exec($ch);
        } catch (\Exception $e) {
            throw new RequestException($method, $url);
        }

        curl_close($ch);

        try {
            $responseJson = json_decode($response, true);
        } catch (\Exception $e) {
            throw new RequestResponseFormatException();
        }

        return $responseJson;
    }

    public function authHeaders(array $headers = []): array
    {
        if (empty($this->auth)) {
            //TODO: Throw no valid Auth
            throw new \Exception('No valid auth');
        }

        return array_merge($headers, $this->auth->headers());
    }
}

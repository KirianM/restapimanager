<?php

namespace KMurgadella\RestApiManager;

use KMurgadella\RestApiManager\Auth\Manager\ManagerInterface;

/**
 * Class ApiManager
 * @package KMurgadella\RestApiManager
 */
class ApiManager implements ApiManagerInterface
{
    /**
     * @var string
     */
    protected $apiUrl;
    /**
     * @var
     */
    protected $auth;

    /**
     * ApiManager constructor.
     * @param string|null $apiUrl
     * @param ManagerInterface|null $auth
     */
    function __construct(string $apiUrl = null, ManagerInterface $auth = null)
    {
        $this->apiUrl = $apiUrl;
        if (!empty($auth)) {
            $this->auth = $auth;
        }
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @return ManagerInterface
     */
    public function getAuth(): ManagerInterface
    {
        return $this->auth;
    }

    /**
     * @param ManagerInterface $auth
     * @return $this
     */
    public function setAuth(ManagerInterface $auth)
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * @param string $apiUrl
     * @return $this
     */
    public function setApiUrl(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @param string $url
     * @param array $headers
     * @return array
     */
    public function get(string $url, array $headers = []): array
    {
        return $this->request('GET', $url, [], $headers);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function put(string $url, array $data, array $headers = []): array
    {
        return $this->request('PUT', $url, $data, $headers);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function post(string $url, array $data, array $headers = []): array
    {
        return $this->request('POST', $url, $data, $headers);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function request(string $method, string $url, array $data = [], array $headers = []): array
    {
        $response = [
            "status" => "success",
            "statusCode" => null,
            "data" => [],
            "errors" => []
        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $url);

        if (in_array($method, ['POST', 'PUT'])) {
            if (!empty($data)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        }

        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        $headers = array_merge($headers, ['Content-Type: application/json']);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        try {
            $request = curl_exec($ch);

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $response['statusCode'] = $http_code;

            if (!preg_match('/^2/', $http_code)) {
                $response['status'] = 'error';
            }

            try {
                $response['data'] = json_decode($request, true);
            } catch (\Exception $e) {
                $response['status'] = 'error';
                $response['errors'][] = $e->getMessage();
            }
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['errors'][] = $e->getMessage();
        }

        curl_close($ch);

        return $response;
    }

    /**
     * @param array $headers
     * @return array
     * @throws \Exception
     */
    public function authHeaders(array $headers = []): array
    {
        if (empty($this->auth)) {
            //TODO: Throw custom exception no valid Auth
            throw new \Exception('No valid auth');
        }

        return array_merge($headers, $this->auth->headers());
    }
}

<?php

namespace KMurgadella\RestApiManager;

use KMurgadella\RestApiManager\Auth\Manager\ManagerInterface;

/**
 * Interface ApiManagerInterface
 * @package KMurgadella\RestApiManager
 */
interface ApiManagerInterface
{
    /**
     * ApiManagerInterface constructor.
     * @param string $apiUrl
     * @param ManagerInterface $auth
     */
    public function __construct(string $apiUrl, ManagerInterface $auth);

    /**
     * @return string
     */
    public function getApiUrl(): string;

    /**
     * @param string $apiUrl
     * @return mixed
     */
    public function setApiUrl(string $apiUrl);

    /**
     * @param string $url
     * @param array $headers
     * @return mixed
     */
    public function get(string $url, array $headers = []);

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function put(string $url, array $data, array $headers = []): array;

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function post(string $url, array $data, array $headers = []): array;

    /**
     * @param string $url
     * @param array $headers
     * @return array
     */
    public function delete(string $url, array $headers = []): array;

    /**
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function request(string $method, string $url, array $data, array $headers): array;

    /**
     * @param array $headers
     * @return array
     */
    public function authHeaders(array $headers = []): array;

    /**
     * @return ManagerInterface
     */
    public function getAuth(): ManagerInterface;

    /**
     * @param ManagerInterface $auth
     * @return mixed
     */
    public function setAuth(ManagerInterface $auth);
}

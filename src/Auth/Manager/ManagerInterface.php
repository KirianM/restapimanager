<?php

namespace KMurgadella\RestApiManager\Auth\Manager;

use KMurgadella\RestApiManager\ApiManagerInterface;
use KMurgadella\RestApiManager\Auth\Model\TokenInterface;

/**
 * Interface ManagerInterface
 * @package KMurgadella\RestApiManager\Auth\Manager
 */
interface ManagerInterface
{
    /**
     * ManagerInterface constructor.
     * @param ApiManagerInterface $apiManager
     * @param string $requestTokenUrl
     * @param array $credentials
     */
    public function __construct(ApiManagerInterface $apiManager, string $requestTokenUrl, array $credentials);

    /**
     * @return ManagerInterface
     */
    public function request(): ManagerInterface;

    /**
     * @return ManagerInterface
     */
    public function refresh(): ManagerInterface;

    /**
     * @return bool
     */
    public function validate(): bool;

    /**
     * @return array
     */
    public function headers(): array;

    /**
     * @return TokenInterface
     */
    public function getToken(): TokenInterface;

    /**
     * @param TokenInterface $token
     * @return mixed
     */
    public function setToken(TokenInterface $token);
}
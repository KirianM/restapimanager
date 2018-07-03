<?php

namespace KMurgadella\RestApiManager\Auth\Manager;

use KMurgadella\RestApiManager\ApiManagerInterface;
use KMurgadella\RestApiManager\Auth\TokenInterface;

interface ManagerInterface
{
    public function __construct(ApiManagerInterface $apiManager, string $requestTokenUrl, array $credentials);

    public function request(): ManagerInterface;

    public function refresh(): ManagerInterface;

    public function validate(): bool;

    public function headers(): array;

    public function getToken(): TokenInterface;

    public function setToken(TokenInterface $token);
}
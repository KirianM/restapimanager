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
     * @return TokenInterface
     */
    public function getToken(): TokenInterface;

    /**
     * @param TokenInterface $token
     * @return mixed
     */
    public function setToken(TokenInterface $token);
}
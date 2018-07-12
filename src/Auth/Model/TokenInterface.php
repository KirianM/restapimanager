<?php

namespace KMurgadella\RestApiManager\Auth\Model;

/**
 * Interface TokenInterface
 * @package KMurgadella\RestApiManager\Auth\Model
 */
interface TokenInterface
{
    /**
     * @return string
     */
    public function getAccessToken(): string;

    /**
     * @param string $access_token
     * @return TokenInterface
     */
    public function setAccessToken(string $access_token): TokenInterface;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @param array $data
     * @return TokenInterface
     */
    public function setData(array $data): TokenInterface;
}
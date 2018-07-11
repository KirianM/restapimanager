<?php

namespace KMurgadella\RestApiManager\Auth\Model;

/**
 * Interface TokenInterface
 * @package KMurgadella\RestApiManager\Auth\Model
 */
interface TokenInterface
{
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
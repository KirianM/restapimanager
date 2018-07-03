<?php

namespace KMurgadella\RestApiManager\Auth;

interface TokenInterface
{
    public function getData(): array;
    public function setData(array $data): TokenInterface;
}
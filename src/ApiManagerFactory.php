<?php

namespace KMurgadella\RestApiManager\Auth;

use KMurgadella\RestApiManager\ApiManager;
use KMurgadella\RestApiManager\Auth\Manager\ManagerInterface;

class ApiManagerFactory
{
    public static function create(string $apiUrl, ManagerInterface $auth = null)
    {
        $instance = null;

        $apiManager = new ApiManager($apiUrl, $auth);

        if ($apiManager) {
            $instance = $apiManager;
        }

        return $instance;
    }
}
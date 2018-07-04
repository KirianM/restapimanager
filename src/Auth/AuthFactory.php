<?php

namespace KMurgadella\RestApiManager\Auth;

use KMurgadella\RestApiManager\ApiManager;
use KMurgadella\RestApiManager\Auth\Manager;

class AuthFactory
{
    public static function create($source, $authUrl, string $requestTokenUrl, array $credentials)
    {
        $instance = null;

        $apiManager = new ApiManager($authUrl);

        switch ($source) {
            case 'jwt':
                $instance = new Manager\Jwt($apiManager, $requestTokenUrl, $credentials);
            break;

            default:
                //TODO: Throw Exception invalid source
        }

        return $instance;
    }
}
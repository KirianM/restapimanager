<?php

namespace KMurgadella\RestApiManager\Auth;

use KMurgadella\RestApiManager\ApiManagerFactory;
use KMurgadella\RestApiManager\Auth\Manager;

class AuthFactory
{
    public static function create(string $source, string $authUrl, string $requestTokenUrl, array $credentials)
    {
        $instance = null;

        $apiManager = ApiManagerFactory::create($authUrl);

        if ($apiManager) {
            switch ($source) {
                case 'jwt':
                    $instance = new Manager\Jwt($apiManager, $requestTokenUrl, $credentials);
                    break;

                default:
                    //TODO: Throw custom Exception no valid source
                    throw new \Exception('No valid source');
            }
        }

        return $instance;
    }
}
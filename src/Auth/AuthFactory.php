<?php

namespace KMurgadella\RestApiManager\Auth;

use KMurgadella\RestApiManager\ApiManagerFactory;
use KMurgadella\RestApiManager\Auth\Manager;

class AuthFactory
{
    public static function create(string $source, array $credentials, string $authUrl = null, string $requestTokenUrl = null)
    {
        $instance = null;

        if (!empty($credentials)) {
            switch ($source) {
                case 'jwt':
                    if (!empty($authUrl) && !empty($requestTokenUrl)) {
                        $apiManager = ApiManagerFactory::create($authUrl);
                        if ($apiManager) {
                            $instance = new Manager\Jwt($apiManager, $requestTokenUrl, $credentials);
                        }
                    }
                    break;

                case 'basic':
                    $instance = new Manager\HttpBasicAuthentication($credentials);
                    break;

                default:
                    //TODO: Throw custom Exception no valid source
                    throw new \Exception('No valid source');
            }
        } else {
            throw new \Exception('No valid credentials');
        }

        return $instance;
    }
}
<?php

namespace KMurgadella\RestApiManager\Auth\Manager;

use KMurgadella\RestApiManager\Auth\Model\HttpBasicAuthentication as HttpBasicAuthenticationModel;
use KMurgadella\RestApiManager\Auth\Model\TokenInterface;

/**
 * Class HttpBasicAuthentication
 * @package KMurgadella\RestApiManager\Auth\Manager
 */
class HttpBasicAuthentication implements ManagerInterface
{
    /**
     * @var
     */
    protected $token;

    /**
     * @var array
     */
    protected $credentials;

    /**
     * OauthBasicAuthentication constructor.
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;

        $model = new HttpBasicAuthenticationModel();
        $model->setData($this->credentials);
        $this->setToken($model);
    }

    /**
     * @return array
     */
    public function headers(): array
    {
        return ['Authorization: ' . $this->token->header()];
    }

    /**
     * @return TokenInterface
     */
    public function getToken(): TokenInterface
    {
        return $this->token;
    }

    /**
     * @param TokenInterface $token
     * @return $this
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
        return $this;
    }
}
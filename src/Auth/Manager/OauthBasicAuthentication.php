<?php

namespace KMurgadella\RestApiManager\Auth\Manager;

use KMurgadella\RestApiManager\Auth\Model\OAuthBasicAuthentication as OAuthBasicAuthenticationModel;
use KMurgadella\RestApiManager\Auth\Model\TokenInterface;

/**
 * Class OauthBasicAuthentication
 * @package KMurgadella\RestApiManager\Auth\Manager
 */
class OauthBasicAuthentication
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
        //TODO: Validate credentials data
        $this->credentials = $credentials;

        $model = new OAuthBasicAuthenticationModel();
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
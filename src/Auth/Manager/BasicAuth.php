<?php

namespace KMurgadella\RestApiManager\Auth\Manager;

use KMurgadella\RestApiManager\Auth\Model\BasicAuth as BasicAuthModel;
use KMurgadella\RestApiManager\Auth\Model\TokenInterface;

/**
 * Class BasicAuth
 * @package KMurgadella\RestApiManager\Auth\Manager
 */
class BasicAuth
{
    /**
     * @var
     */
    protected $token;

    /**
     * BasicAuth constructor.
     * @param string $access_token
     */
    public function __construct(string $access_token)
    {
        $model = new BasicAuthModel();
        $model->setData(['access_token' => $access_token]);
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
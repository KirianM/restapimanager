<?php

namespace KMurgadella\RestApiManager\Auth\Manager;

use KMurgadella\RestApiManager\ApiManagerInterface;
use KMurgadella\RestApiManager\Auth\Model\Jwt as JwtModel;
use KMurgadella\RestApiManager\Auth\Model\TokenInterface;

/**
 * Class Jwt
 * @package KMurgadella\RestApiManager\Auth\Manager
 */
class Jwt implements ManagerInterface
{
    /**
     * @var
     */
    protected $token;
    /**
     * @var ApiManagerInterface
     */
    protected $apiManager;
    /**
     * @var string
     */
    protected $requestTokenUrl;
    /**
     * @var array
     */
    protected $credentials;

    /**
     * Jwt constructor.
     * @param ApiManagerInterface $apiManager
     * @param string $requestTokenUrl
     * @param array $credentials
     */
    public function __construct(ApiManagerInterface $apiManager, string $requestTokenUrl, array $credentials)
    {
        $this->apiManager = $apiManager;
        $this->requestTokenUrl = $requestTokenUrl;
        //TODO: Validate credentials data
        $this->credentials = $credentials;
    }

    /**
     * @return ManagerInterface
     * @throws \Exception
     */
    public function request(): ManagerInterface
    {
        $request = $this->apiManager->post($this->requestTokenUrl, $this->credentials);
        if ($request['status'] == 'success') {
            $model = new JwtModel();
            $model->setData($request['data']);
            $this->setToken($model);
        } else {
            //TODO: Throw custom Exception cannot get new token
            throw new \Exception('Cannot request new token');
        }

        return $this;
    }

    /**
     * @return ManagerInterface
     */
    public function refresh(): ManagerInterface
    {
        // TODO: Implement refresh() method.
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        // TODO: Implement validate() method.
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
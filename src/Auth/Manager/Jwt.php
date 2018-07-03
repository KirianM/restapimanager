<?php

namespace KMurgadella\RestApiManager\Auth\Manager;

use KMurgadella\RestApiManager\ApiManagerInterface;
use KMurgadella\RestApiManager\Auth\Model\Jwt as JwtModel;

class Jwt implements ManagerInterface
{
    protected $token;
    protected $apiManager;
    protected $requestTokenUrl;
    protected $credentials;

    public function __construct(ApiManagerInterface $apiManager, string $requestTokenUrl, array $credentials)
    {
        $this->apiManager = $apiManager;
        $this->requestTokenUrl = $requestTokenUrl;
        //TODO: Validate credentials data
        $this->credentials = $credentials;
    }

    public function request(): ManagerInterface
    {
        $request = $this->apiManager->post($this->requestTokenUrl, $this->credentials);
        if (!empty($request)) {
            $model = new JwtModel();
            $model->setData($request);
        } else {
            //TODO: Throw Exception cannot get new token
        }

        return $this;
    }

    public function refresh(): ManagerInterface
    {
        // TODO: Implement refresh() method.
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }

    public function headers(): array
    {
        return [
            'Authorization' => $this->token->header()
        ];
    }
}
<?php

namespace KMurgadella\RestApiManager\Auth\Model;

use  KMurgadella\RestApiManager\Auth\TokenInterface;

class Jwt implements TokenInterface
{
    protected $access_token;
    protected $token_type;
    protected $expires_in;

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token)
    {
        $this->access_token = $access_token;
    }

    public function getTokenType(): string
    {
        return $this->token_type;
    }

    public function setTokenType(string $token_type)
    {
        $this->token_type = $token_type;
    }

    public function getExpiresIn(): string
    {
        return $this->expires_in;
    }

    public function setExpiresIn(int $expires_in)
    {
        $this->expires_in = $expires_in;
    }

    public function getData(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'token_type' => $this->getTokenType(),
            'expires_in' => $this->getExpiresIn()
        ];
    }

    public function setData(array $data): TokenInterface
    {
        if (array_key_exists('access_token', $data)) {
            $this->setAccessToken($data['access_token']);
        } else {
            //TODO: Throw invalid token request response
        }

        if (array_key_exists('token_type', $data)) {
            $this->setTokenType($data['token_type']);
        } else {
            //TODO: Throw invalid token request response
        }

        if (array_key_exists('expires_in', $data)) {
            $this->setExpiresIn($data['expires_in']);
        } else {
            //TODO: Throw invalid token request response
        }

        return $this;
    }

    public function header(): string
    {
        return $this->getTokenType() . ' ' . $this->getAccessToken();
    }
}
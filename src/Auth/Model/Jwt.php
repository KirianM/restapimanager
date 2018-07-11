<?php

namespace KMurgadella\RestApiManager\Auth\Model;

/**
 * Class Jwt
 * @package KMurgadella\RestApiManager\Auth\Model
 */
class Jwt implements TokenInterface
{
    /**
     * @var
     */
    protected $access_token;
    /**
     * @var
     */
    protected $token_type;
    /**
     * @var
     */
    protected $expires_in;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     * @return $this
     */
    public function setAccessToken(string $access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @param string $token_type
     * @return $this
     */
    public function setTokenType(string $token_type)
    {
        $this->token_type = $token_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiresIn(): string
    {
        return $this->expires_in;
    }

    /**
     * @param int $expires_in
     * @return $this
     */
    public function setExpiresIn(int $expires_in)
    {
        $this->expires_in = $expires_in;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'token_type' => $this->getTokenType(),
            'expires_in' => $this->getExpiresIn()
        ];
    }

    /**
     * @param array $data
     * @return TokenInterface
     * @throws \Exception
     */
    public function setData(array $data): TokenInterface
    {
        if (array_key_exists('access_token', $data)) {
            $this->setAccessToken($data['access_token']);
        } else {
            //TODO: Throw custom Exception invalid token
            throw new \Exception('Invalid token');
        }

        if (array_key_exists('token_type', $data)) {
            $this->setTokenType($data['token_type']);
        } else {
            //TODO: Throw custom Exception invalid token type
            throw new \Exception('Invalid token tuype');
        }

        if (array_key_exists('expires_in', $data)) {
            $this->setExpiresIn($data['expires_in']);
        } else {
            //TODO: Throw custom Exception invalid expiration
            throw new \Exception('Invalid expiration');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function header(): string
    {
        return sprintf('%s %s', $this->getTokenType(), $this->getAccessToken());
    }
}
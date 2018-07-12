<?php

namespace KMurgadella\RestApiManager\Auth\Model;

/**
 * Class BasicAuth
 * @package KMurgadella\RestApiManager\Auth\Model
 */
class BasicAuth implements TokenInterface
{
    /**
     * @var
     */
    protected $access_token;
    /**
     * @var
     */
    protected $token_type = 'Basic';

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     * @return TokenInterface
     */
    public function setAccessToken(string $access_token): TokenInterface
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
     * @return array
     */
    public function getData(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'token_type' => $this->getTokenType()
        ];
    }

    /**
     * @param array $data
     * @return TokenInterface
     * @throws \Exception
     */
    public function setData(array $data): TokenInterface
    {
        if (array_key_exists('access_token', $data) && !empty($data['access_token'])) {
            $this->setAccessToken($data['access_token']);
        } else {
            //TODO: Throw custom Exception invalid token
            throw new \Exception('Invalid token');
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
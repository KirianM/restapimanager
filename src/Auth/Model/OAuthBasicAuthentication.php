<?php

namespace KMurgadella\RestApiManager\Auth\Model;

/**
 * Class OAuthBasicAuthentication
 * @package KMurgadella\RestApiManager\Auth\Model
 */
class OAuthBasicAuthentication implements TokenInterface
{
    /**
     * @var
     */
    protected $username;
    /**
     * @var
     */
    protected $password;
    /**
     * @var
     */
    protected $token_type = 'Basic';

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return TokenInterface
     */
    public function setUsername(string $username): TokenInterface
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return TokenInterface
     */
    public function setPassword(string $password): TokenInterface
    {
        $this->password = $password;
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
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
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
        if (array_key_exists('username', $data) && !empty($data['username'])) {
            $this->setUsername($data['username']);
        } else {
            //TODO: Throw custom Exception invalid username
            throw new \Exception('Invalid username');
        }

        if (array_key_exists('password', $data) && !empty($data['password'])) {
            $this->setUsername($data['password']);
        } else {
            //TODO: Throw custom Exception invalid password
            throw new \Exception('Invalid password');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function header(): string
    {
        return sprintf('%s %s', $this->getTokenType(), $this->hash($this->getData()));
    }

    protected function hash(array $data): string
    {
        return base64_encode(sprintf('%s:%s', $data['username'], $data['password']));
    }
}
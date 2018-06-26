<?php

namespace KMurgadella\ResrApiManager\src;

use KMurgadella\ResrApiManager\src\Exeption\RequestException;
use KMurgadella\ResrApiManager\src\Exeption\RequestResponseFormatException;

class ApiManager implements ApiManagerInterface
{
    protected $apiUrl;
    protected $connection;

    function __construct(string $apiUrl = null)
    {
        $this->apiUrl = $apiUrl;
    }

    public function setApiUrl(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    protected function connect()
    {
        //TODO: Obtain a new OAuth token if necessary
        return true;
    }

    public function get(string $url)
    {
        return $this->request('GET', $url);
    }

    public function put(string $url, array $data)
    {
        return $this->request('PUT', $url);
    }

    public function post(string $url, array $data)
    {
        return $this->request('POST', $url);
    }

    protected function request(string $method, string $url, array $data = [], array $headers = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->_apiUrl.$url);

        if(in_array($method, ['POST', 'PUT']))
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            if(!empty($data))
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }

        if(!empty($headers))
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        try {
            $response = curl_exec($ch);
        } catch (\Exception $e) {
            throw new \RequestException($method, $url);
        }

        curl_close($ch);

        try {
            $responseJson = json_decode($response);
        } catch (\Exception $e) {
            throw new \RequestResponseFormatException();
        }

        return $responseJson;
    }
}

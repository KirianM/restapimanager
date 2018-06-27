<?php

namespace KMurgadella\RestApiManager\Exception;

class RequestException extends \Exception
{
    public function __construct($method, $url, \Exception $previous = null)
    {
        $message = sprintf('Error on %s request to: %s', $method, $url);
        parent::__construct($message, 1, $previous);
    }
}

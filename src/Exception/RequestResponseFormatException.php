<?php

namespace KMurgadella\src\Exeption;

class RequestResponseFormatException extends Exception
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct('Error while trying to decode response', 2, $previous);
    }
}

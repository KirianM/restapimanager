<?php

namespace KMurgadella\RestApiManager\Auth;

interface AuthInterface
{
    public function request();

    public function refresh();
}
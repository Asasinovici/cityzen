<?php

namespace Core;

class Request
{
    public $method = null;
    public $uri = null;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }
}
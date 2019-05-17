<?php

namespace Core;


class App
{
    static $instance = null;
    public $routes = [];

    static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new App();
        }

        return self::$instance;
    }

    public function __construct()
    {
    }

    public function setRoutes($routes = [])
    {
        $this->routes = $routes;
    }

    public function run()
    {
        $request = new Request();

        $route = explode('/', $request->uri);
        unset($route[0]);
        $route = '/' . implode('/', $route);

        if (!isset($this->routes[$route])) {
            return new View('global/error.php', [
                'error' => 'Unknown route'
            ]);
        }
        if ($request->method !== $this->routes[$route]['method']) {
            return new View('global/error.php', [
                'error' => 'Wrong HTTP method!'
            ]);
        }

        return new View('global/test.php', ['test' => 'this is working']);
    }
}
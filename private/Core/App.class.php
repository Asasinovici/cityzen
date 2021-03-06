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
        $handler = explode('@', $this->routes[$route]['handler']);
        $controllerFileName = $handler[0];
        $function = $handler[1];
        if (!file_exists(Config::getPrivatePath('Controllers/' . $controllerFileName . '.class.php'))) {
            return new View('global/error.php', [
                'error' => 'Controller does not exist!'
            ]);
        }

        require_once(Config::getPrivatePath('/Controllers/' . $controllerFileName . '.class.php'));

        $controllerClass = '\\Controllers\\' . $controllerFileName;

        $controller = new $controllerClass();

        if (!method_exists($controller, $function) || !is_callable([$controller, $function])) {
            return new View('global/error.php', [
                'error' => 'Controller function cannot be called or doesnt exist!'
            ]);
        }

        $controller->$function($request);
    }
}
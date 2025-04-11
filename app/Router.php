<?php

declare(strict_types=1);

namespace App;

class Router
{
    private array $routes = [];

    private function register(string $route, string $method, callable $callback)
    {
        $this->routes[$method][$route] = $callback;
    }

    public function get(string $route, callable $callback)
    {
        $this->register($route, 'get', $callback);
    }

    public function post(string $route, callable $callback)
    {
        $this->register($route, 'post', $callback);
    }

    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        $requestUri = explode('?', $requestUri)[0];

        if (strlen($requestUri) > 1 && str_ends_with($requestUri, '/')) {
            $requestUri = substr($requestUri, 0, -1);
        }

        if (!isset($this->routes[strtolower($requestMethod)][$requestUri])) {
            throw new \Exception('This Page Not Found');
        }

        $action = $this->routes[strtolower($requestMethod)][$requestUri];
        return call_user_func($action);
    }
}

<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\NotFoundException;

class Router
{
    private array $routes = [];

    private function register(string $route, string $method, callable|array $callback)
    {
        $this->routes[$method][$route] = $callback;
    }

    public function get(string $route, callable|array $callback)
    {
        $this->register($route, 'get', $callback);
    }

    public function post(string $route, callable|array $callback)
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
            throw new NotFoundException();
        }

        $action = $this->routes[strtolower($requestMethod)][$requestUri];
        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$namespace, $method] = $action;
        $class = new $namespace;
        return call_user_func_array([$class, $method], []);
    }
}

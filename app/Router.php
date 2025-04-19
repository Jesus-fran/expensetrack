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
        return $this;
    }

    public function get(string $route, callable|array $callback)
    {
        return $this->register($route, 'get', $callback);
    }

    public function post(string $route, callable|array $callback)
    {
        return $this->register($route, 'post', $callback);
    }

    public function routes(): array
    {
        return $this->routes;
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

        $is_a_function_callable = is_callable($action);
        if ($is_a_function_callable) {
            return call_user_func($action);
        }

        if (count($action) !== 2) {
            throw new NotFoundException();
        }

        [$namespace, $method] = $action;

        if ($namespace === null || !class_exists($namespace)) {
            throw new NotFoundException();
        }

        $class = new $namespace;

        if ($method === null || !method_exists($class, $method)) {
            throw new NotFoundException();
        }

        return call_user_func_array([$class, $method], []);
    }
}

<?php

namespace App;

class App
{
    private string $requestUri;
    private string $requestMethod;

    public function __construct(private Router $router, array $request)
    {
        [$this->requestUri, $this->requestMethod] = $request;
    }

    public function run(): void
    {
        echo $this->router->resolve($this->requestUri, $this->requestMethod);
    }
}

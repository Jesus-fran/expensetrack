<?php

declare(strict_types=1);
use App\Exceptions\NotFoundException;
use App\Router;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase
{

    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }

    public function test_router_is_register_get()
    {
        $this->router->get('/testing', ['User', 'index']);
        $expected = ['get' => ['/testing' => ['User', 'index']]];

        $this->assertSame($expected, $this->router->routes());
    }

    public function test_router_is_register_post()
    {
        $this->router->post('/testing', ['User', 'index']);
        $expected = ['post' => ['/testing' => ['User', 'index']]];

        $this->assertSame($expected, $this->router->routes());
    }

    public function test_router_is_empty_is_new()
    {
        $this->assertEmpty((new Router)->routes());
    }

    #[DataProvider('additionProvider')]
    public function test_it_throw_is_executed_in_resolve(string $requestUri, string $requestMethod)
    {
        $user = new class {
            public function save()
            {
                return true;
            }
        };

        $this->router->get('/invoice', ['invoice', 'index']);
        $this->router->get('/user', [$user::class, 'index']);
        $this->router->get('/email', [$user::class, null]);

        $this->expectException(NotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    public static function AdditionProvider(): array
    {
        return [
            'When route is incorrect' => ['/invoice-asdfasdf', 'get'],
            'When method is incorrect' => ['/invoice', 'post'],
            'When method and route is correct but class is not' => ['/invoice', 'get'],
            'When method of class is incorrect' => ['/user', 'get'],
            'When callback is incorrect or nullable' => ['/email', 'get'],
        ];
    }
}

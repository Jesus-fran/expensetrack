<?php

declare(strict_types=1);
use App\Exceptions\NotFoundException;
use App\Router;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\Unit\DataProvider\RouterDataProvider;

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

    #[DataProviderExternal(RouterDataProvider::class, 'AdditionProvider')]
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
}

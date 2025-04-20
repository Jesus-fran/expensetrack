<?php

namespace App;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;

class App
{
    private string $requestUri;
    private string $requestMethod;
    public static DB $db;
    public static Container $container;

    public function __construct(private Router $router, array $request)
    {
        [$this->requestUri, $this->requestMethod] = $request;
        static::$db = new DB();
        static::$container = new Container();
        static::$container->set(InvoiceService::class, function (Container $container) {
            return new InvoiceService(
                $container->get(SalesTaxService::class),
                $container->get(PaymentGatewayService::class),
                $container->get(EmailService::class)
            );
        });

        static::$container->set(SalesTaxService::class, fn() => new SalesTaxService());
        static::$container->set(PaymentGatewayService::class, fn() => new PaymentGatewayService());
        static::$container->set(EmailService::class, fn() => new EmailService());
    }

    public function run(): void
    {
        echo $this->router->resolve($this->requestUri, $this->requestMethod);
    }
}

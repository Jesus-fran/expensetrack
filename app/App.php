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

    public function __construct(private Router $router, array $request, protected InvoiceService $invoiceService)
    {
        [$this->requestUri, $this->requestMethod] = $request;
        static::$db = new DB();
    }

    public function run(): void
    {
        echo $this->router->resolve($this->requestUri, $this->requestMethod, $this->invoiceService);
    }
}

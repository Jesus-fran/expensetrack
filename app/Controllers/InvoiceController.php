<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;

class InvoiceController
{
    public function index()
    {
        $customer = ['name' => 'Dimitry'];
        $amount = 1500;

        $invoiceService = (new InvoiceService(
            new SalesTaxService,
            new PaymentGatewayService,
            new EmailService
        ))->process($customer, $amount);

        if ($invoiceService) {
            echo "Invoice process sucessfull!";
        }
    }
}
<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Container;
use App\Services\InvoiceService;

class InvoiceController
{
    public function index()
    {
        $customer = ['name' => 'Dimitry'];
        $amount = 1500;

        $invoiceService = (new Container)->get(InvoiceService::class);
        $invoiceProcess = $invoiceService->process($customer, $amount);

        if ($invoiceProcess) {
            echo "Invoice process sucessfull!";
        }
    }
}
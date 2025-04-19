<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\InvoiceService;

class InvoiceController
{

    public function __construct(protected InvoiceService $invoiceService)
    {
    }

    public function index()
    {
        $customer = ['name' => 'Dimitry'];
        $amount = 1500;

        $invoiceService = ($this->invoiceService)->process($customer, $amount);

        if ($invoiceService) {
            echo "Invoice process sucessfull!";
        }
    }
}
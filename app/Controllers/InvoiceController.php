<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\InvoiceService;

class InvoiceController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }

    public function index()
    {
        $customer = ['name' => 'Dimitry'];
        $amount = 1500;

        $invoiceProcess = $this->invoiceService->process($customer, $amount);

        if ($invoiceProcess) {
            echo "Invoice process sucessfull!";
        }
    }
}
<?php

declare(strict_types=1);

namespace App\Services;

class InvoiceService
{

    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayService $paymentGatewayService,
        protected EmailService $emailService
    ) {
    }

    public function process(array $customer, float $amount): bool
    {
        # 1. Calculates sales tax
        $tax = $this->salesTaxService->calculate($amount, $customer);

        # 2. Process invoice 
        if (!$this->paymentGatewayService->charge($customer, $amount, $tax)) {
            return false;
        }

        # 3. send receipt
        $this->emailService->send($customer, 'receipt');

        return true;
    }
}
<?php

namespace Tests\Unit;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;
use PHPUnit\Framework\TestCase;

final class InvoiceServiceTest extends TestCase
{
    public function test_if_invoice_proces(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $paymentGatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);
        $paymentGatewayServiceMock->method('charge')->willReturn(true);
        # give a invoice 
        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $paymentGatewayServiceMock,
            $emailServiceMock
        );

        $customer = ['name' => 'John Doe'];
        $amount = 250;

        # When a process the invoice
        $process = $invoiceService->process($customer, $amount);

        # Expected a asset successful
        $this->assertTrue($process);
    }

    public function test_it_send_email()
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $paymentGatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);
        $paymentGatewayServiceMock->method('charge')->willReturn(true);
        # give a invoice 
        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $paymentGatewayServiceMock,
            $emailServiceMock
        );

        $customer = ['name' => 'John Doe'];
        $amount = 250;

        $emailServiceMock->expects($this->once())->method('send')->with($customer, 'receipt');

         # When a process the invoice
         $process = $invoiceService->process($customer, $amount);

         # Expected a asset successful
         $this->assertTrue($process);
    }
}

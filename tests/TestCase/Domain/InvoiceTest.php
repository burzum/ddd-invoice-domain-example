<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Test\TestCase\Domain;

use DateTime;
use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Common\Currency;
use Psa\Invoicing\Common\Deconstruct;
use Psa\Invoicing\Common\Salutation;
use Psa\Invoicing\Domain\Address;
use Psa\Invoicing\Domain\Invoice;
use Psa\Invoicing\Domain\InvoiceLine;
use Psa\Invoicing\Domain\InvoiceLinesCollection;
use Psa\Invoicing\Domain\ItemId;
use Psa\Invoicing\Domain\PaymentStatus;
use Psa\Invoicing\Domain\Price;
use Psa\Invoicing\Domain\Service\InvoiceCalculator;
use Psa\Invoicing\Domain\Service\VATCalculator;
use Ramsey\Uuid\Uuid;

/**
 * Invoice Test
 */
class InvoiceTest extends TestCase
{
    /**
     * testCreating
     *
     * @return void
     */
    public function testCreating(): void
    {
        $this->markTestSkipped('incomplete');

        $address = new Address(
            null,
            Salutation::MR(),
            'Florian',
            null,
            'Krämer',
            'PSA Publishers Ltd.',
            'Langstraße 31',
            null,
            'Zürich',
            '12345',
            'CH',
            'ZH'
        );

        $invoiceLines = new InvoiceLinesCollection();
        $invoiceLines->add(new InvoiceLine(null, '1', 'test', 10, new Price(10, Currency::EUR())));
        $invoiceLines->add(new InvoiceLine(null, '2', 'test', 10, new Price(10, Currency::EUR())));

        $invoiceCalculator = new InvoiceCalculator();

        $invoice = new Invoice(
            $address,
            $invoiceLines,
            (string)(Uuid::uuid4()),
            null,
            'EUR',
            '1234'
        );

        $result = $invoice->jsonSerialize();
        var_dump($result);
    }
}

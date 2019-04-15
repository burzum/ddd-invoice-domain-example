<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Test\TestCase\Domain;

use DateTime;
use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Common\Country;
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
use Psa\Invoicing\Domain\Service\Tax\SwissVatRule;
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
        $this->markTestSkipped();
        $invoice = new Invoice(
            new InvoiceCalculator(),
            new Address(
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
                Country::CHE(),
                'ZH'
            ),
            Currency::EUR(),
            (string)(Uuid::uuid4()),
            null,
            '1234'
        );

        $invoice->addLine(new InvoiceLine(null, '1', 'This', 10, new Price(9.01, Currency::EUR())));
        $invoice->addLine(new InvoiceLine(null, '2', 'That', 3, new Price(10.11, Currency::EUR())));

        $this->assertEquals(120.43, $invoice->getGross());
        $this->assertEquals(140, $invoice->getNett());
        $this->assertEquals(140, $invoice->getVAT());


        // $result = $invoice->jsonSerialize();
        //var_dump(json_encode($invoice->jsonSerialize()));
        //var_dump($result);
    }
}

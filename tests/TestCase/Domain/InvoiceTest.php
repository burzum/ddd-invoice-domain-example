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
use Psa\Invoicing\Domain\Price;
use Psa\Invoicing\Domain\Service\InvoiceCalculator;
use Psa\Invoicing\Domain\Service\VATCalculator;

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
        $data = [
            'address' => [

            ],
            'invoice_lines' => [
                [
                    'item_name' => '',
                    'item_description' => '',
                    'price' => '19.99',
                    'quantity' => '3'
                ]
            ]
        ];

        $address = Address::create(
            null,
            Salutation::MR(),
            'First',
            'Last',
            '',
            'Coding Ally 1',
            '',
            'php',
            '123456',
            'Germany'
        );

        $address = Address::create(
            null,
            Salutation::MR(),
            'Florian',
            'Krämer',
            '',
            'Coding Ally 1',
            '',
            'php',
            '123456',
            'Germany'
        );

        $invoiceLines = new InvoiceLinesCollection();
        $invoiceLines->add(new InvoiceLine(null, new ItemId(1), 'test', 10, new Price(10, Currency::EUR())));
        $invoiceLines->add(new InvoiceLine(null, new ItemId(2), 'test', 10, new Price(10, Currency::EUR())));

        $invoiceCalculator = new InvoiceCalculator();

        $invoice = Invoice::create(
            $invoiceCalculator,
            $address,
            $invoiceLines,
            Currency::EUR(),
            new DateTime()
        );

        Deconstruct::toArray($invoice);
        //var_dump($invoice);
    }
}

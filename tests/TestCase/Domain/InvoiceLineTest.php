<?php
declare(strict_types=1);

namespace Psa\Invoicing\Test\TestCase\Domain;

use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Common\Currency;
use Psa\Invoicing\Domain\InvoiceLine;
use Psa\Invoicing\Domain\Price;

/**
 * Invoice Test
 */
class InvoiceLineTest extends TestCase
{
    /**
     * invoiceLineTest
     *
     * @return void
     */
    public function testInvoiceLine(): void
    {
        $line = new InvoiceLine(
            null,
            '1',
            'Book',
            2,
            new Price(5.99, Currency::CHF()),
            null
        );

        $this->assertInstanceOf(Price::class, $line->getTotal());
        $this->assertEquals(11.98, $line->getTotal()->getValue());
    }
}

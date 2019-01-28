<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

use Psa\Invoicing\Domain\Invoice;

/**
 * InvoiceCalculator
 */
class InvoiceCalculator
{

    protected $VATCalculator;

    public function __construct()
    {
    }

    /**
     *
     */
    public function calculate(Invoice $invoice): InvoiceCalculatorResult
    {
        $gross = 0.00;
        $nett = 0.00;
        $vat = 0.00;

        foreach ($invoice->getLines() as $line) {
            $gross += $line->getPrice()->getValue();
        }

        return new InvoiceCalculatorResult(
            $gross,
            $nett,
            $vat
        );
    }
}

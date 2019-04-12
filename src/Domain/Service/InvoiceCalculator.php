<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

use Psa\Invoicing\Domain\Invoice;

/**
 * InvoiceCalculator
 */
class InvoiceCalculator
{
    /**
     * Calculates the invoices total to pay
     *
     * @param \Psa\Invoicing\Domain\Invoice
     * @return mixed
     */
    public function calculate(Invoice $invoice): InvoiceCalculatorResult
    {
        $gross = 0.00;
        $nett = 0.00;
        $vat = 0.00;

        foreach ($invoice->getLines() as $line) {
            $gross += $line->getPrice()->getValue();
        }

        $this->VATCalculator->generate();

        return new InvoiceCalculatorResult(
            $gross,
            $nett,
            $vat
        );
    }
}

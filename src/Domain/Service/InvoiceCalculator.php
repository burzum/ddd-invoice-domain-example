<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

use Psa\Invoicing\Common\Country;
use Psa\Invoicing\Domain\Invoice;
use Psa\Invoicing\Domain\Service\Tax\VATCalculator;

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

        /**
         * @var \Psa\Invoicing\Domain\InvoiceLine $line
         */
        foreach ($invoice->getLines() as $line) {
            $nett += $line->getTotal()->getValue();
        }

        $VATCalculator = new VATCalculator();
        $vatResult = $VATCalculator->calculate(new Country($invoice->getCountryCode()), $nett);

        return new InvoiceCalculatorResult(
            $vatResult->getGross(),
            $vatResult->getNett(),
            $vatResult->getVat(),
            $vatResult->getTaxRate()
        );
    }
}

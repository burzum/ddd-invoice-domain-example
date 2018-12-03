<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

/**
 * InvoiceCalculator
 */
class InvoiceCalculator
{

    protected $VATCalculator;

    public function __construct(VATCalculator $VATCalculator)
    {
        $this->VATCalculator = $VATCalculator;
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

<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service\Tax;

use Psa\Invoicing\Common\Country;
use Psa\Invoicing\Domain\Invoice;

/**
 * VATCalculator
 */
class VATCalculator
{
    /**
     * Calculates the VAT for an invoice
     *
     * @return
     */
    public function calculate(Invoice $invoice)
    {
        $countryCode = $invoice->getCountryCode();
        if ($countryCode === Country::CHE() || $countryCode === Country::LIE()) {
            return (new SwissVatRule())->calculate($nett);
        }

        $vat = (float)0;
        $percent = (float)0;
        $gross = $nett + $vat;

        return new VATResult($gross, $nett, $vat, $percent);
    }
}

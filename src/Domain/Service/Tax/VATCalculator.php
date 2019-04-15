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
     * @return \Psa\Invoicing\Domain\Service\Tax\VATResultInterface
     */
    public function calculate(Country $country, float $gross)
    {
        if ($country->equals(Country::CHE()) || $country->equals(Country::LIE())) {
            return (new SwissVatRule())->calculate($gross);
        }

        $vat = (float)0;
        $percent = (float)0;
        $nett = $gross + $vat;

        return new VATResult($gross, $nett, $vat, $percent);
    }
}

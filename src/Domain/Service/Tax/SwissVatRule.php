<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service\Tax;

/**
 * VAT Tax Calculator for Switzerland
 */
class SwissVatRule
{
    const TAX_RATE = 7.7;

    /**
     * Method used to calc VAT
     *
     * Since we have only services as buyable items so far yet and export of
     * services falls not under the tax law in Switzerland, we don't calculate
     * a VAT when the country is not Switzerland.
     *
     * @param float $nett Total amount before tax has been applied
     * @return \Psa\Invoicing\Domain\Service\Tax\VATResultInterface
     */
    public function calculate(float $nett) : VATResultInterface
    {
        $vat = ($nett / 100) * static::TAX_RATE;
        $vat = (float)sprintf('%.2f', $vat);
        $vat = $this->round($vat);
        $gross = $this->round($nett + $vat);

        return new VATResult($gross, $nett, $vat, static::TAX_RATE);
    }

    /**
     * Method to round off a value as per the custom rules for switzerland
     *
     * @param float $value Value to be rounded as per custom rules
     * @param int $countryId Country Id
     * @return float
     */
    protected function round(float $value) : float
    {
        return (float)(round($value / 0.05) * 0.05);
    }
}

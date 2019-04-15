<?php
declare(strict_types=1);

namespace Psa\Invoicing\Domain\Service\Tax;

use JsonSerializable;

/**
 * VAT Calculation Result Object
 */
class VATResult implements VATResultInterface
{
    /**
     * VAT
     *
     * @var float
     */
    protected $vat = 0.00;

    /**
     * Tax Rate
     *
     * @var float
     */
    protected $taxRate = 0.00;

    /**
     * Gross
     *
     * @var float
     */
    protected $gross = 0.00;

    /**
     * Nett
     *
     * @var float
     */
    protected $nett = 0.00;

    /**
     * Constructor
     *
     * @param float $gross Gross
     * @param float $nett Nett
     * @param float $vat VAT value
     * @param float $taxRate Tax Rate
     */
    public function __construct(float $gross, float $nett, float $vat, float $taxRate)
    {
        $trimNumber = function ($float) {
            return (float)sprintf('%.2f', $float);
        };

        $this->vat = $trimNumber($vat);
        $this->taxRate = $trimNumber($taxRate);
        $this->gross = $trimNumber($gross);
        $this->nett = $trimNumber($nett);
    }

    /**
     * Gets the gross
     *
     * @return float
     */
    public function getGross(): float
    {
        return $this->gross;
    }

    /**
     * Gets the nett
     *
     * @return float
     */
    public function getNett(): float
    {
        return $this->nett;
    }

    /**
     * Gets the VAT value
     *
     * @return float
     */
    public function getVat(): float
    {
        return $this->vat;
    }

    /**
     * Gets the percentage
     *
     * @return float
     */
    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    /**
     * Converts the object to an array
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'vat' => $this->vat,
            'taxRate' => $this->taxRate,
            'gross' => $this->gross,
            'nett' => $this->nett
        ];
    }
}

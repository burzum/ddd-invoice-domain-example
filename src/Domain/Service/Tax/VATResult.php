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
     * VAT in percentage
     *
     * @var float
     */
    protected $percentage = 0.00;

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
     * @param float $percentage VAT in percent
     */
    public function __construct(float $gross, float $nett, float $vat, float $percentage)
    {
        $this->vat = $vat;
        $this->percentage = $percentage;
        $this->gross = $gross;
        $this->nett = $nett;
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
    public function getPercentage(): float
    {
        return $this->percentage;
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
            'percentage' => $this->percentage,
            'gross' => $this->gross,
            'nett' => $this->nett
        ];
    }
}

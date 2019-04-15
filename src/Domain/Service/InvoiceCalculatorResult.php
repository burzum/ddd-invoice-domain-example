<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

/**
 * InvoiceCalculatorResult
 */
class InvoiceCalculatorResult
{
    /**
     * @var float
     */
    protected $gross = 0.00;

    /**
     * @var float
     */
    protected $nett = 0.00;

    /**
     * @var float
     */
    protected $VAT = 0.00;

    /**
     * @var float
     */
    protected $taxRate = 0.00;

    /**
     * @param float $gross Gross
     * @param float $nett Nett
     * @param float $VAT VAT
     * @param float $taxRate VAT Tax Rate
     */
    public function __construct(
        float $gross,
        float $nett,
        float $VAT,
        float $taxRate
    ) {
        $this->gross = $gross;
        $this->nett = $nett;
        $this->VAT = $VAT;
        $this->taxRate = $taxRate;
    }

    /**
     * @return float
     */
    public function getGross(): float
    {
        return $this->gross;
    }

    /**
     * @return float
     */
    public function getNett(): float
    {
        return $this->nett;
    }

    /**
     * @return float
     */
    public function getVAT(): float
    {
        return $this->VAT;
    }

    /**
     * @return float
     */
    public function getTaxRate(): float
    {
        return $this->taxRate;
    }
}

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

    public function __construct(
        float $gross,
        float $nett,
        float $VAT
    ) {
        $this->gross = $gross;
        $this->nett = $nett;
        $this->VAT = $VAT;
    }

    /**
     * @return float
     */
    public function getGross()
    {
        return $this->gross;
    }

    /**
     * @return float
     */
    public function getNett()
    {
        return $this->nett;
    }

    /**
     * @return float
     */
    public function getVAT()
    {
        return $this->VAT;
    }
}

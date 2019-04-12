<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Psa\Invoicing\Common\Currency;

/**
 * Price
 */
class Price
{
    /**
     * @var \Psa\Invoicing\Common\Currency
     */
    protected $currency;

    /**
     * Value
     *
     * @var float
     */
    protected $value;

    /**
     * Construct
     *
     * @param float $value Value
     * @param \Psa\Invoicing\Common\Currency
     */
    public function __construct(
        float $value,
        Currency $currency
    ) {
        $this->currency = $currency;
        $this->value = $value;
    }

    /**
     * Gets the currency
     *
     * @return \Psa\Invoicing\Common\Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Gets the value
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}

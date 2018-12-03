<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

/**
 * Price
 */
class Price
{

    protected $currency;
    protected $value;

    public function __construct(
        float $value,
        string $currency
    ) {
        $this->currency = $currency;
        $this->value = $value;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getValue()
    {
        return $this->value;
    }
}

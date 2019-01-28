<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Psa\Invoicing\Common\Currency;

/**
 * Price
 */
class Price
{

    protected $currency;
    protected $value;

    public function __construct(
        float $value,
        Currency $currency
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

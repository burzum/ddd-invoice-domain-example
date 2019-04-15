<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use JsonSerializable;
use Psa\Invoicing\Common\Currency;

/**
 * Price
 */
class Price implements JsonSerializable
{
    /**
     * Currency
     *
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
     * @param \Psa\Invoicing\Common\Currency Currency
     */
    public function __construct(
        float $value,
        Currency $currency
    ) {
        $this->currency = $currency;
        $this->value = $value;
    }

    /**
     * Checks if this object is the same as another one
     *
     * @param \Psa\Invoicing\Domain\Price $price Price
     * @return bool
     */
    public function isSameAs(Price $price): bool
    {
        return $this->currency === $price->getCurrency()
            && $this->value === $price->getValue();
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

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'value' => $this->value,
            'currency' => (string)$this->currency
        ];
    }
}

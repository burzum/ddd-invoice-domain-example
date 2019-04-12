<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
use Psa\Invoicing\Common\EntityInterface;

/**
 * InvoiceLine
 */
class InvoiceLine implements EntityInterface
{
    protected $id;
    protected $itemId;
    protected $itemName;
    protected $itemDescription;
    protected $quantity;
    protected $price;
    protected $currency;

    /**
     * Constructor
     */
    public function __construct(
        ?string $id,
        string $itemId,
        string $itemName,
        int $quantity,
        Price $price,
        ?string $description = null
    ) {
        Assert::that($itemId)->notBlank();
        Assert::that($itemName)->notBlank();

        $this->id = $id;
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->itemDescription = $description;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * Gets the price
     *
     * @return \Psa\Invoicing\Domain\Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * Gets the total price
     *
     * @return \Psa\Invoicing\Domain\Price
     */
    public function getTotal(): Price
    {
        return new Price($this->price->getValue() * $this->quantity, $this->currency);
    }

    /**
     *
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Gets the id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'item_id' => $this->itemName,
            'item_name' => $this->itemName,
            'item_description' => $this->itemName,
            'price' => $this->getPrice(),
            'quantity' => $this->quantity,
            'total' => $this->getTotal()
        ];
    }
}

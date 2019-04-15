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
    protected $total;

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
        Assert::that($quantity)->greaterThan(0);

        $this->id = $id;
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->itemDescription = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = new Price(
            $this->price->getValue() * (float)$this->quantity,
            $this->price->getCurrency()
        );
    }

    /**
     * Is the same as
     *
     * @param \Psa\Invoicing\Domain\InvoiceLine $invoiceLine Invoice Line
     * @return bool
     */
    public function isSameAs(InvoiceLine $invoiceLine): bool
    {
        return $this->price->isSameAs($invoiceLine->getPrice())
            && $this->itemId === $invoiceLine->getItemId();
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
        return $this->total;
    }

    /**
     * Gets the item id
     *
     * @return string|int
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

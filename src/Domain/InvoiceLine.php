<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;

/**
 * InvoiceLine
 */
class InvoiceLine
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
        ?int $id,
        ItemId $itemId,
        string $itemName,
        int $quantity,
        Price $price,
        ?string $description = null
    ) {
        Assert::that($itemId)->notBlank();
        Assert::that($itemName)->notBlank();
        Assert::that($price)->float();

        $this->id = $id;
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->itemDescription = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = new Price((float)($this->price->getValue() * $this->quantity), $price->getCurrency());
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getTotal(): Price
    {
        return new Price($this->price->getValue() * $this->quantity, $this->currency);
    }

    public function getId(): int
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'item_id' => $this->itemName,
            'item_name' => $this->itemName,
            'item_description' => $this->itemName,
            'price' => $this->quantity,
            'quantity' => $this->quantity
        ];
    }
}

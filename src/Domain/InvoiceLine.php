<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

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
        int $itemId,
        string $itemName,
        int $quantity,
        Price $price,
        ?string $description = null
    ) {
        $this->id = $id;
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->itemDescription = $description;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getTotal(): Price
    {
        return new Price($this->price * $this->quantity, $this->currency);
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

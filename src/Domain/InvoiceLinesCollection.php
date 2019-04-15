<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use RuntimeException;

/**
 * Invoice Lines Collection
 */
class InvoiceLinesCollection implements IteratorAggregate, Countable, JsonSerializable
{
    /**
     * Lines
     *
     * @var array
     */
    protected $lines = [];

    /**
     * Construct
     *
     * @var array $lines Array of line items
     */
    public function __construct(array $lines = [])
    {
        foreach ($lines as $line) {
            $this->add($line);
        }
    }

    /**
     * Add an invoice line
     *
     * @param \Psa\Invoicing\Domain\InvoiceLine
     * @return $this
     */
    public function add(InvoiceLine $line): InvoiceLinesCollection
    {
        foreach ($this->lines as $existingLine) {
            if ($existingLine->isSameAs($line)) {
                throw new RuntimeException('The line item already exists on this invoice');
            }
        }

        $this->lines[] = $line;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->lines);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->lines);
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
        return $this->lines;
    }
}

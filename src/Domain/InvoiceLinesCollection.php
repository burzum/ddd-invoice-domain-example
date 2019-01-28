<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate ;

/**
 * Invoice Lines Collection
 */
class InvoiceLinesCollection implements IteratorAggregate, Countable
{
    /**
     * Lines
     *
     * @var array
     */
    protected $lines = [];

    public function add(InvoiceLine $line)
    {
        $this->lines[] = $line;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->lines);
    }

    public function count(): int
    {
        return count($this->lines);
    }
}

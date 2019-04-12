<?php
declare(strict_types=1);

namespace Psa\Invoicing\Test\TestCase\Domain;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Domain\InvoiceLinesCollection;

/**
 * InvoiceLinesCollectionTest
 */
class InvoiceLinesCollectionTest extends TestCase
{
    /**
     * testCollection
     *
     * @return void
     */
    public function testCollection(): void
    {
        $collection = new InvoiceLinesCollection();
        $this->assertCount(0, $collection);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }
}

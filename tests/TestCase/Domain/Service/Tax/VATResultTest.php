<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Test\TestCase\Domain\Service\Tax;

use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Domain\Service\Tax\SwissVatRule;
use Psa\Invoicing\Domain\Service\Tax\VATResult;

/**
 * VAT Result Test
 */
class VATResultTest extends TestCase
{
    /**
     * testResult
     *
     * @return void
     */
    public function testResult(): void
    {
        $result = new VATResult(15, 10, 5, 50.00);

        $this->assertEquals(15, $result->getGross());
        $this->assertEquals(10, $result->getNett());
        $this->assertEquals(5, $result->getVat());
        $this->assertEquals(50.00, $result->getTaxRate());
    }
}

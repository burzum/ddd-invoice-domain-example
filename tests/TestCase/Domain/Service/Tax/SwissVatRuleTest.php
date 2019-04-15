<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Test\TestCase\Domain\Service\Tax;

use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Domain\Service\Tax\SwissVatRule;

/**
 * Invoice Test
 */
class SwissVatRuleTest extends TestCase
{
    /**
     * testCreating
     *
     * @return void
     */
    public function testCalculate(): void
    {
        $rule = new SwissVatRule();

        $result = $rule->calculate((float)10.00);

        $this->assertEquals((float)7.7, $result->getTaxRate());
        $this->assertEquals(0.75, $result->getVat());
        $this->assertEquals((float)10.75, $result->getGross());
        $this->assertEquals((float)10.0, $result->getNett());
    }
}

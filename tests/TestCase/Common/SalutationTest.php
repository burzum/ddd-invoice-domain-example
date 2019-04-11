<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Common\Salutation;

/**
 * SalutationTest
 */
class SalutationTest extends TestCase
{
    /**
     * testSalutations
     *
     * @return void
     */
    public function testSalutations(): void
    {
        $this->assertEquals('mr', Salutation::MR());
        $this->assertEquals('ms', Salutation::MS());
        $this->assertEquals('mrs', Salutation::MRS());
    }
}

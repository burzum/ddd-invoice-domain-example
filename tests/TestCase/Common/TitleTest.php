<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Common\Title;

/**
 * Title Test
 */
class TitleTest extends TestCase
{
    /**
     * testTitles
     *
     * @return void
     */
    public function testTitles(): void
    {
        $this->assertEquals('dr', Title::DR());
    }
}

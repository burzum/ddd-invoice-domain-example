<?php
declare(strict_types=1);

namespace Psa\Invoicing\Test\TestCase\Domain;

use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Common\Salutation;
use Psa\Invoicing\Common\Title;
use Psa\Invoicing\Domain\Address;
use Psa\Invoicing\Domain\DueDate;

/**
 * DueDateTest
 */
class DueDateTest extends TestCase
{

    /**
     * test due date
     *
     * @return void
     */
    public function testDueDate(): void
    {
        $dueDate = new DueDate();

        $date = new \DateTime('+13 days');
        $this->assertTrue($dueDate > $date);

        $date = new \DateTime('+15 days');
        $this->assertTrue($dueDate < $date);
    }
}

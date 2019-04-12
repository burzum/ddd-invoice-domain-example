<?php
declare(strict_types=1);

namespace Psa\Invoicing\Test\TestCase\Domain;

use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Common\Salutation;
use Psa\Invoicing\Common\Title;
use Psa\Invoicing\Domain\Address;

/**
 * Address Test
 */
class AddressTest extends TestCase
{
    /**
     * testCreate
     *
     * @return void
     */
    public function testCreate(): void
    {
        $address = new Address(
            null,
            Salutation::MR(),
            'Florian',
            null,
            'Krämer',
            'PSA Publishers Ltd.',
            'Langstraße 31',
            null,
            'Zürich',
            '12345',
            'CH',
            'ZH'
        );
    }
}

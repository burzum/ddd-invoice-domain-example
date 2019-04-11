<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

final class FancyAggregate
{

    protected $someField;
    protected $someOtherField;
    // ... 20 more

    public function doThis()
    {
    }
    public function doThat()
    {
    }

    public function __sleep()
    {
        // TODO: Implement __sleep() method.
    }

    public function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }
}

interface FancyWriteRepositoryInterface
{

    public function saveNew(FancyAggregate $aggregate);
}

$writeRepository->saveNewFancyAggregate();
$readRepository->saveNewFancyAggregate(...);

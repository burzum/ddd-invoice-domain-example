<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
use MyCLabs\Enum\Enum;

/**
 * ItemId
 */
class ItemId
{
    protected $id;

    public function __construct($id)
    {
        if (is_int($id)) {
            Assert::that($id)->greaterThan(0);
            $this->id = $id;
            return;
        }

        Assert::that($id)->uuid();
    }

    public function getValue()
    {
        return $this->id;
    }
}

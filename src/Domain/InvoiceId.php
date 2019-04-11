<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
use Ramsey\Uuid\Uuid;

/**
 * ItemId
 */
class InvoiceId
{
    protected $id;

    public function __construct(?$id = null)
    {
        if ($id === null) {
            $id = (string)(Uuid::uuid4());
        }

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

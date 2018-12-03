<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Command;

use Psa\Invoicing\Domain\InvoiceFactory;
use Psa\Invoicing\Domain\InvoiceReadRepositoryInterface;

/**
 * DeleteInvoiceCommand
 */
class DeleteInvoiceCommand
{
    /**
     *
     */
    protected $id;

    /**
     *
     */
    public function __construct(int $id)
    {
        $this->id;
    }

    /**
     *
     */
    public function getId(): int
    {
        return $this->id;
    }
}

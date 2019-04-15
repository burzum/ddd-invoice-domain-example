<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

/**
 * SequentialInvoiceNumberRepositoryInterface
 */
interface SequentialInvoiceNumberRepositoryInterface
{
    public function getNextId(): int;
}

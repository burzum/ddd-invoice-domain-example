<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

class CakeInvoiceReadRepository implements InvoiceReadRepositoryInterface
{

    public function getById(string $string): Invoice;

    public function getNextId(): int;
}

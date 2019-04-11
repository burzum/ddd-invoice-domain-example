<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

interface InvoiceReadRepositoryInterface
{

    public function getById(string $string): Invoice;
}

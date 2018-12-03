<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

/**
 * InvoiceWriteRepositoryInterface
 */
interface InvoiceWriteRepositoryInterface
{

    public function create(Invoice $invoice);

    public function update(Invoice $invoice);

    public function delete(Invoice $invoice);
}

<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Event;

use Psa\Invoicing\Domain\Invoice;
use Psa\Invoicing\Domain\InvoiceFactory;
use Psa\Invoicing\Domain\InvoiceReadRepositoryInterface;

/**
 *
 */
class InvoicePaidEvent
{

    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }
}

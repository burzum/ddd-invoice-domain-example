<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Exception;

use Psa\Invoicing\Domain\Invoice;
use Psa\Invoicing\Domain\InvoiceLine;

/**
 * CurrencyMissMatchException
 */
class CurrencyMissMatchException extends InvoiceException
{
    /**
     * Line Item
     *
     * @var \Psa\Invoicing\Domain\InvoiceLine
     */
    protected $item;

    /**
     * Invoice
     *
     * @var \Psa\Invoicing\Domain\Invoice
     */
    protected $invoice;

    /**
     * Create
     *
     * @param \Psa\Invoicing\Domain\Invoice
     * @param \Psa\Invoicing\Domain\InvoiceLine
     * @return $this
     */
    public static function create(Invoice $invoice, InvoiceLine $line)
    {
        $exception = new self(
            sprintf(
                'Invoice expects currency %s, but got %s from %s',
                $invoice->getCurrency(),
                $line->getCurrency(),
                $line->getItemName()
            )
        );

        $exception->invoice = $invoice;
        $exception->line = $line;

        return $exception;
    }

    /**
     * Line Item
     *
     * @return \Psa\Invoicing\Domain\InvoiceLine
     */
    public function getItem(): InvoiceLine
    {
        return $this->line;
    }

    /**
     * Gets the invoice
     *
     * @return \Psa\Invoicing\Domain\Invoice
     */
    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }
}

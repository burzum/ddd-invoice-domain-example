<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Envms\FluentPDO\Query;

/**
 * Invoice Repository
 */
class InvoiceRepository
{
    /**
     * @var \Envms\FluentPDO\Query
     */
    protected $query;

    /**
     * @var string
     */
    protected $table = 'invoices';

    /**
     * Constructor
     *
     * @var \Envms\FluentPDO\Query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * Gets an invoice by id
     *
     * @param string $id Uuid
     * @return \Psa\Invoicing\Domain\Invoice
     */
    public function getInvoiceById($id): Invoice
    {
        $result = $this->query
            ->from($this->table)
            ->where('id', $id);
    }

    public function update(Invoice $invoice)
    {
    }

    /**
     * Saves an invoice
     */
    public function save(Invoice $invoice)
    {
        $values = [

        ];

        $result = $this->query
            ->insertInto($this->table)
            ->values($values)
            ->execute();

        foreach ($invoiceLine as $line) {
            $values = [];

            $result = $this->query
                ->insertInto('invoice_lines')
                ->values($values)
                ->execute();
        }
    }
}

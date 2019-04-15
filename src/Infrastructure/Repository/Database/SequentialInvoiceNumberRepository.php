<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Envms\FluentPDO\Query;

/**
 * Invoice Repository
 */
class SequentialInvoiceNumberRepository implements SequentialInvoiceNumberRepositoryInterface
{
    /**
     * @var \Envms\FluentPDO\Query
     */
    protected $query;

    /**
     * @var string
     */
    protected $table = 'invoice_numbers';

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
     * @inheritDoc
     */
    public function getNextId(): int
    {
        return (int)$this->query
            ->insertInto($this->table)
            ->values([])
            ->execute();
    }
}

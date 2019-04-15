<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

use Psa\Invoicing\Domain\SequentialInvoiceNumberRepositoryInterface;

/**
 * InvoiceCalculatorResult
 */
class InvoiceNumberGenerator
{
    /**
     *
     */
    protected $repository;

    /**
     *
     */
    public function __construct(SequentialInvoiceNumberRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     */
    public function generate()
    {
        return (string)$this->repository->getNextId();
    }
}

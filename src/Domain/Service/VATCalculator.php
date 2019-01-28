<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

/**
 *
 */
class VATCalculator
{

    protected $repository;

    public function __construct(
        InvoiceReadRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function generate(): string
    {
        return $this->repository->getNextId();
    }
}

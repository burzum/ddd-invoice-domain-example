<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service;

use Psa\Invoicing\Domain\InvoiceReadRepositoryInterface;

/**
 *
 */
class InvoiceNumberGenerator
{

    protected $repository;

    public function __construct(
        InvoiceReadRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function generate(): int
    {
        return $this->repository->getNextId();
    }

}

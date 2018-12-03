<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Command;

use Psa\Invoicing\Domain\InvoiceFactory;
use Psa\Invoicing\Domain\InvoiceReadRepositoryInterface;

/**
 *
 */
class CreateInvoiceHandler
{

    public function __construct(
        InvoiceFactory $factory,
        InvoiceWriteRepositoryInterface $repository
    ) {
        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function handle(CreateInvoiceCommand $command)
    {
        $command->getData();
        $invoice = $this->factory->fromArray($command->getData());
        $this->repository->save($invoice);
    }

}

<?php
namespace Psa\Invoicing\Command;

use Psa\Invoicing\InvoiceReadRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 *
 */
class ViewInvoiceHandler implements RequestHandlerInterface
{

    protected $repository;

    public function __construct(
        InvoiceReadRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $invoice = $this->repository->getById((string)$request->getAttribute('id'));

        return new Response(200, $invoice);
    }
}

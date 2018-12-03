<?php
namespace Psa\Invoicing\Command;

use http\Env\Response;
use Psa\Invoicing\InvoiceFactory;
use Psa\Invoicing\InvoiceReadRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 *
 */
class ViewInvoice implements RequestHandlerInterface
{

    protected $repository;

    public function __construct(
        InvoiceReadRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->Validator->validate($request->getData())) {

        }

        $command = new CreateInvoiceCommand($request->getData());
        $this->dispatcher($command);
    }

}

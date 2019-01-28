<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Psa\Invoicing\Domain\Address;
use Psa\Invoicing\Domain\DueDate;
use Psa\Invoicing\Domain\Invoice;
use Psa\Invoicing\Domain\InvoiceLinesCollection;

/**
 * InvoiceFactory
 */
class InvoiceFactory
{
    protected $addressRepo;

    public function __construct(
        ReadRepositoryInterface $addressRepo
    ) {
    }

    public function fromArray($array): Invoice
    {
        $lines = new InvoiceLinesCollection();
        if (isset($array['invoice_lines'])) {
            foreach ($array['invoice_lines'] as $line) {
                $lines->add(
                    new InvoiceLine(
                        isset($line['item_name']) ? $line['item_name'] : null,
                        isset($line['price']) ? $line['price'] : null,
                        isset($line['quantity']) ? $line['quantity'] : null,
                        isset($line['currency']) ? $line['description'] : null
                    )
                );
            }
        }

        // Is it valid to do this?
        if (isset($array['address_id'])) {
            $address = $this->addressRepo->findById((int)$array['address_id']);
        } else {
            $address = new Address(
                $array['address']['first_name'],
                $array['address']['last_name'],
                $array['address']['company'],
                $array['address']['street'],
                $array['address']['street2'],
                $array['address']['city'],
                $array['address']['zip'],
                $array['address']['country']
            );
        }

        $invoice = new Invoice(
            $address,
            $lines,
            new InvoiceCalculator()
        );

        $invoice->calculate();

        return $invoice;
    }
}

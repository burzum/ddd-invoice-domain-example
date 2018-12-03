<?php
namespace Psa\Invoicing\Test\TestCase;

use DateTime;
use PHPUnit\Framework\TestCase;
use Psa\Invoicing\Domain\Address;
use Psa\Invoicing\Domain\Invoice;
use Psa\Invoicing\Domain\InvoiceLinesCollection;
use Psa\Invoicing\Domain\Service\InvoiceCalculator;
use Psa\Invoicing\Domain\Service\VATCalculator;

class InvoiceTest extends TestCase {

	public function testCreating() {
		$data = [
			'address' => [

			],
			'invoice_lines' => [
				[
					'item_name' => '',
					'item_description' => '',
					'price' => '19.99',
					'quantity' => '3'
				]
			]
		];

		$address = Address::create(
			'',
			'Mr',
			'Florian',
			'Krämer',
			'',
			'Coding Ally 1',
			'',
			'php',
			'123456',
			'Germany'
		);

		$invoiceLines = new InvoiceLinesCollection();

		$invoice = Invoice::create(
			$address,
			$invoiceLines,
			new DateTime(),
			'EUR'
		);

		var_dump($invoice->toArray());
	}
}

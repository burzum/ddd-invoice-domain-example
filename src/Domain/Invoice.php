<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
use DateTime;
use DateTimeInterface;
use DateInterval;
use Psa\Invoicing\Common\Currency;
use Psa\Invoicing\Domain\Exception\CurrencyMissMatchException;
use Psa\Invoicing\Domain\Exception\EmptyInvoiceException;
use Psa\Invoicing\Domain\Service\InvoiceCalculator;

/**
 * Invoice Aggregate
 */
class Invoice
{
    protected $id = null;
    protected $Address = null;
    protected $InvoiceLines = null;
    protected $calculator = null;
    protected $paymentStatus = PaymentStatus::UNPAID;
    protected $gross = 0.00;
    protected $nett = 0.00;
    protected $vat = 0.00;
    protected $currency = Currency::DEFAULT;
    protected $vatPercent = 0.00;
    protected $dueDate = null;
    protected $firstReminder = null;
    protected $secondReminder = null;
    protected $invoiceDate = null;
    protected $paidDate = null;
    protected $invoiceNumber = null;
    protected $status;

    /**
     * Constructor
     */
    public function __construct(
        Address $address,
        InvoiceLinesCollection $invoiceLines
    ) {
        Assert::that($invoiceLines, 'An invoice must have at least one item')->minCount(1);

        $this->Address = $address;
        $this->InvoiceLines = $invoiceLines;
    }

    /**
     * Sets the due date and the reminder dates based on the due date
     *
     * @param null|\DateTimeInterface $date Date
     * @return $this
     */
    protected function calculateDueDates(?DateTimeInterface $date = null): self
    {
        if (empty($data)) {
            $date = new DueDate();
        }

        $this->dueDate = $date;

        $this->firstReminder = clone $date;
        $this->firstReminder->add(new DateInterval('P14D'));

        $this->secondReminder = clone $this->firstReminder;
        $this->secondReminder->add(new DateInterval('P14D'));

        return $this;
    }

    /**
     * Flags the invoice as paid
     */
    public function paid(
        ?DateTimeInterface $paymentDate,
        ?PaymentStatus $paymentStatus
    ) {
        $this->paymentDate = $paymentDate === null ? new DateTime() : $paymentDate;
        $this->paymentStatus = $paymentStatus === null ? PaymentStatus::PAID() : $paymentStatus;

        return $this;
    }

    /**
     *
     */
    public function addLine(InvoiceLine $line)
    {
        if ($this->currency !== $line->getPrice()->getValue()) {
            throw CurrencyMissMatchException::create($this, $line);
        }

        $this->InvoiceLines->add($line);
    }

    /**
     *
     */
    public function getLines(): InvoiceLinesCollection
    {
        return $this->InvoiceLines;
    }

    /**
     * @link https://softwareengineering.stackexchange.com/questions/357969/ddd-injecting-services-on-entity-methods-calls
     */
    public function calculate(InvoiceCalculator $calculator)
    {
        $result = $calculator->calculate($this);

        $this->gross = $result->getGross();
        $this->nett = $result->getNett();
        $this->VAT = $result->getVAT();
    }

    /**
     * Creates a new invoice
     *
     * @return \Psa\Invoicing\Domain\Invoice
     */
    public static function create(
        InvoiceCalculator $invoiceCalculator,
        Address $address,
        InvoiceLinesCollection $invoiceLines,
        Currency $currency,
        ?DateTime $invoiceDate
    ): Invoice {
        $invoice = new self($address, $invoiceLines);
        $invoice->currency = $currency;
        $invoice->invoiceDate = $invoiceDate === null ? new DateTime() : $invoiceDate;
        $invoice->calculateDueDates();
        $invoice->calculate($invoiceCalculator);

        return $invoice;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoiceNumber,
            'gross' => $this->gross,
            'nett' => $this->nett,
            'vat' => $this->vat,
            'address' => $this->Address->toArray(),
            'invoice_lines' => $this->InvoiceLines->toArray()
        ];
    }
}

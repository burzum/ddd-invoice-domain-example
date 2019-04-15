<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
use DateTime;
use DateTimeInterface;
use DateInterval;
use Psa\Invoicing\Common\AggregateInterface;
use Psa\Invoicing\Common\Currency;
use Psa\Invoicing\Domain\Exception\CurrencyMissMatchException;
use Psa\Invoicing\Domain\Service\InvoiceCalculator;

/**
 * Invoice Aggregate
 */
class Invoice implements AggregateInterface
{
    /**
     * @var \Psa\Invoicing\Domain\Address
     */
    protected $Address = null;

    /**
     * @var \Psa\Invoicing\Domain\InvoiceLinesCollection
     */
    protected $InvoiceLines = null;

    /**
     * Calculator
     *
     * @var \Psa\Invoicing\Domain\Service\InvoiceCalculator
     */
    protected $Calculator;

    protected $id = null;
    protected $calculator = null;
    protected $paymentStatus = PaymentStatus::UNPAID;
    protected $gross = 0.00;
    protected $nett = 0.00;
    protected $VAT = 0.00;
    protected $currency;
    protected $vatTaxRate = 0.00;
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
        InvoiceCalculator $Calculator,
        Address $address,
        ?Currency $currencyCode,
        string $id,
        ?string $companyId,
        string $invoiceNumber
    ) {
        Assert::that($id)->uuid();

        $this->Address = $address;
        $this->Calculator = $Calculator;
        $this->InvoiceLines = new InvoiceLinesCollection();

        $this->id = $id;
        $this->companyId = $companyId;
        $this->currency = $currencyCode === null ? Currency::CHF() : $currencyCode;
        $this->invoiceNumber = $invoiceNumber;
        $this->paymentStatus = PaymentStatus::UNPAID();
    }

    /**
     * Sets the due date and the reminder dates based on the due date
     *
     * @param null|\DateTimeInterface $date Date
     * @return $this
     */
    protected function calculateDueDates(?DateTimeInterface $date = null): self
    {
        if ($date === null) {
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
     *
     * @return $this
     */
    public function paid(
        ?DateTimeInterface $paymentDate,
        ?PaymentStatus $paymentStatus
    ): self {
        $this->paymentDate = $paymentDate === null ? new DateTime() : $paymentDate;
        $this->paymentStatus = $paymentStatus === null ? PaymentStatus::PAID() : $paymentStatus;

        return $this;
    }

    /**
     * Adds an invoice line
     *
     * @param \Psa\Invoicing\Domain\InvoiceLine $line Line
     * @return $this
     */
    public function addLine(InvoiceLine $line): self
    {
        if (!$this->currency->equals($line->getPrice()->getCurrency())) {
            throw CurrencyMissMatchException::create($this, $line);
        }

        $this->InvoiceLines->add($line);
        // Should this be the only place to call this?
        $this->calculate();

        return $this;
    }

    /**
     * Gets the line items
     *
     * @return \Psa\Invoicing\Domain\InvoiceLinesCollection
     */
    public function getLines(): InvoiceLinesCollection
    {
        return $this->InvoiceLines;
    }

    /**
     * Gets the address
     *
     * @return \Psa\Invoicing\Domain\Address
     */
    public function getAddress(): Address
    {
        return $this->Address;
    }

    /**
     * Calculates the invoice
     *
     * @link https://softwareengineering.stackexchange.com/questions/357969/ddd-injecting-services-on-entity-methods-calls
     */
    protected function calculate()
    {
        $result = $this->Calculator->calculate($this);

        $this->gross = $result->getGross();
        $this->nett = $result->getNett();
        $this->VAT = $result->getVAT();
        $this->vatTaxRate = $result->getTaxRate();
    }

    /**
     * getVATTaxRate
     *
     * @return float
     */
    public function getVATTaxRate(): float
    {
        return $this->vatTaxRate;
    }

    /**
     * Gross
     *
     * @return float
     */
    public function getGross(): float
    {
        return $this->gross;
    }

    /**
     * Nett
     *
     * @return float
     */
    public function getNett(): float
    {
        return $this->nett;
    }

    /**
     * VAT
     *
     * @return float
     */
    public function getVAT(): float
    {
        return $this->VAT;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getCountryCode()
    {
        return $this->Address->getCountryCode();
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoiceNumber,
            'gross' => $this->gross,
            'nett' => $this->nett,
            'vat' => $this->VAT,
            'address' => $this->Address->jsonSerialize(),
            'invoice_lines' => $this->InvoiceLines->jsonSerialize()
        ];
    }
}

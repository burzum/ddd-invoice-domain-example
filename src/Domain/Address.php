<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
use Psa\Invoicing\Common\Country;
use Psa\Invoicing\Common\Salutation;
use Psa\Invoicing\Common\Title;
use RuntimeException;

/**
 * Address
 */
class Address
{
    protected $title = '';
    protected $salutation = '';
    protected $firstName = '';
    protected $middleName = '';
    protected $lastName = '';
    protected $company = '';
    protected $street = '';
    protected $street2 = null;
    protected $city = null;
    protected $zip = null;
    protected $country = null;

    /**
     * Creates a new address
     */
    public function __construct(
        ?Title $title = null,
        ?Salutation $salutation = null,
        string $firstName,
        ?string $middleName = null,
        string $lastName,
        ?string $company = null,
        string $street,
        ?string $street2 = null,
        string $city,
        string $zip,
        string $country,
        string $countryState
    ) {
        if (empty($company) && empty($lastName)) {
            throw new RuntimeException('The address cant have an empty company and name');
        }

        $this->title = $title;
        $this->salutation = $salutation;
        $this->firstName = $firstName;
        $this->middlename = $middleName;
        $this->lastName = $lastName;
        $this->company = $company;
        $this->street = $street;
        $this->street2 = $street2;
        $this->city = $city;
        $this->zip = $city;
        $this->country = $country;
    }

    public function getCountryCode()
    {
        return $this->country;
    }
}

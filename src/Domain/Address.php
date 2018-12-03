<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use RuntimeException;

/**
 * Address
 */
class Address
{

    protected $title = '';
    protected $salutation = '';
    protected $firstName = '';
    protected $lastName = '';
    protected $company = '';
    protected $street = '';
    protected $street2 = null;
    protected $city = null;
    protected $zip = null;
    protected $country = null;

    public static function create(
        string $title = '',
        string $salutation = '',
        string $firstName = '',
        string $lastName = '',
        string $company = '',
        string $street,
        string $street2 = '',
        string $city,
        string $zip,
        string $country
    ) {
        if (empty($company) && empty($lastName)) {
            throw new RuntimeException('The address cant have an empty company and name');
        }

        $address = new self();
        $address->title = $title;
        $address->salutation = $salutation;
        $address->firstName = $firstName;
        $address->lastName = $lastName;
        $address->company = $company;
        $address->street = $street;
        $address->street2 = $street2;
        $address->city = $city;
        $address->zip = $city;
        $address->country = $country;

        return $address;
    }

    public function getStreet()
    {

    }

    public function getStreet2()
    {

    }

    public function getFirstName()
    {

    }

    public function getLastName()
    {
        if (empty($this->company) && empty($this->lastName)) {
            throw new RuntimeException('The address cant have an empty company and name');
        }
    }

    public function getCompany()
    {
        if (empty($this->company) && empty($this->lastName)) {
            throw new RuntimeException('The address cant have an empty company and name');
        }
    }
}

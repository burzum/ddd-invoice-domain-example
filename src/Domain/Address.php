<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
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
    public static function create(
        ?Title $title = null,
        ?Salutation $salutation = null,
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
}

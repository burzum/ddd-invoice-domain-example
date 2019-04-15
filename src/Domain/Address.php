<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use Assert\Assert;
use Psa\Invoicing\Common\Country;
use Psa\Invoicing\Common\EntityInterface;
use Psa\Invoicing\Common\Salutation;
use Psa\Invoicing\Common\Title;
use RuntimeException;

/**
 * Address
 */
class Address implements EntityInterface
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
        Country $country,
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
            'title' => $this->title,
            'salutation' => (string)$this->salutation,
            'first_name' => $this->firstName,
            'middle_name' => $this->middlename,
            'last_name' => $this->lastName,
            'company' => $this->company,
            'street' => $this->street,
            'street2' => $this->street2,
            'city' => $this->city,
            'zip' => $this->zip,
            'country' => $this->country,
        ];
    }
}

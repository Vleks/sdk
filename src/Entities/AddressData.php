<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model as BaseModel;
use Vleks\SDK\Entities\CompanyData;

class AddressData extends BaseModel
{
    public function __construct($data = null)
    {
        $this->fields = array (
                'SalutationCode'    => array ('value' => null, 'type' => 'string'),
                'Firstname'         => array ('value' => null, 'type' => 'string'),
                'Surname'           => array ('value' => null, 'type' => 'string'),
                'StreetName'        => array ('value' => null, 'type' => 'string'),
                'HouseNumber'       => array ('value' => null, 'type' => 'string'),
                'PostalCode'        => array ('value' => null, 'type' => 'string'),
                'City'              => array ('value' => null, 'type' => 'string'),
                'CountryCode'       => array ('value' => null, 'type' => 'string'),
                'Email'             => array ('value' => null, 'type' => 'string'),
                'Company'           => array ('value' => null, 'type' => CompanyData::class)
        );

        parent::__construct($data);
    }

    public function setSalutationCode ($value)
    {
        $this->fields['SalutationCode']['value'] = $value;
        return $this;
    }

    public function getSalutationCode ()
    {
        return $this->fields['SalutationCode']['value'];
    }

    public function hasSalutationCode ()
    {
        return !is_null($this->fields['SalutationCode']['value']);
    }
    
    public function setFirstname ($value)
    {
        $this->fields['Firstname']['value'] = $value;
        return $this;
    }

    public function getFirstname ()
    {
        return $this->fields['Firstname']['value'];
    }

    public function hasFirstname ()
    {
        return !is_null($this->fields['Firstname']['value']);
    }
    
    public function setSurname ($value)
    {
        $this->fields['Surname']['value'] = $value;
        return $this;
    }

    public function getSurname ()
    {
        return $this->fields['Surname']['value'];
    }

    public function hasSurname ()
    {
        return !is_null($this->fields['Surname']['value']);
    }
    
    public function setStreetName ($value)
    {
        $this->fields['StreetName']['value'] = $value;
        return $this;
    }

    public function getStreetName ()
    {
        return $this->fields['StreetName']['value'];
    }

    public function hasStreetName ()
    {
        return !is_null($this->fields['StreetName']['value']);
    }

    public function setHouseNumber ($value)
    {
        $this->fields['HouseNumber']['value'] = $value;
        return $this;
    }

    public function getHouseNumber ()
    {
        return $this->fields['HouseNumber']['value'];
    }

    public function hasHouseNumber ()
    {
        return !is_null($this->fields['HouseNumber']['value']);
    }

    public function setPostalCode ($value)
    {
        $this->fields['PostalCode']['value'] = $value;
        return $this;
    }

    public function getPostalCode ()
    {
        return $this->fields['PostalCode']['value'];
    }

    public function hasPostalCode ()
    {
        return !is_null($this->fields['PostalCode']['value']);
    }

    public function setCity ($value)
    {
        $this->fields['City']['value'] = $value;
        return $this;
    }

    public function getCity ()
    {
        return $this->fields['City']['value'];
    }

    public function hasCity ()
    {
        return !is_null($this->fields['City']['value']);
    }

    public function setCountryCode ($value)
    {
        $this->fields['CountryCode']['value'] = $value;
        return $this;
    }

    public function getCountryCode ()
    {
        return $this->fields['CountryCode']['value'];
    }

    public function hasCountryCode ()
    {
        return !is_null($this->fields['CountryCode']['value']);
    }

    public function setEmail ($value)
    {
        $this->fields['Email']['value'] = $value;
        return $this;
    }

    public function getEmail ()
    {
        return $this->fields['Email']['value'];
    }

    public function hasEmail ()
    {
        return !is_null($this->fields['Email']['value']);
    }

    public function setCompany ($value)
    {
        $this->fields['Company']['value'] = $value;
        return $this;
    }

    public function getCompany ()
    {
        return $this->fields['Company']['value'];
    }

    public function hasCompany ()
    {
        return !is_null($this->fields['Company']['value']);
    }
}

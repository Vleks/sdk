<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model as BaseModel;

class CompanyData extends BaseModel
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'CompanyName'       => array ('value' => null, 'type' => 'string'),
            'Department'        => array ('value' => null, 'type' => 'string'),
            'VATNumber'         => array ('value' => null, 'type' => 'string'),
            'CoCNumber'         => array ('value' => null, 'type' => 'string')
        );

        parent::__construct($data);
    }

    public function setCompanyName ($value)
    {
        $this->fields['CompanyName']['value'] = $value;
        return $this;
    }

    public function getCompanyName ()
    {
        return $this->fields['CompanyName']['value'];
    }

    public function hasCompanyName ()
    {
        return !is_null($this->fields['CompanyName']['value']);
    }
    
    public function setDepartment ($value)
    {
        $this->fields['Department']['value'] = $value;
        return $this;
    }

    public function getDepartment ()
    {
        return $this->fields['Department']['value'];
    }

    public function hasDepartment ()
    {
        return !is_null($this->fields['Department']['value']);
    }
    
    public function setVATNumber ($value)
    {
        $this->fields['VATNumber']['value'] = $value;
        return $this;
    }

    public function getVATNumber ()
    {
        return $this->fields['VATNumber']['value'];
    }

    public function hasVATNumber ()
    {
        return !is_null($this->fields['VATNumber']['value']);
    }
    
    public function setCoCNumber ($value)
    {
        $this->fields['CoCNumber']['value'] = $value;
        return $this;
    }

    public function getCoCNumber ()
    {
        return $this->fields['CoCNumber']['value'];
    }

    public function hasCoCNumber ()
    {
        return !is_null($this->fields['CoCNumber']['value']);
    }
}

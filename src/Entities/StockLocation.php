<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;

class StockLocation extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'LocationID'      => array ('value' => null, 'type' => 'string'),
            'QuantityInStock' => array ('value' => null, 'type' => 'int')
        );

        parent::__construct($data);
    }

    public function setLocationID ($value)
    {
        $this->fields['LocationID']['value'] = $value;
        return $this;
    }

    public function getLocationID ()
    {
        return $this->fields['LocationID']['value'];
    }

    public function hasLocationID ()
    {
        return !is_null($this->fields['LocationID']['value']);
    }

    public function setQuantityInStock ($value)
    {
        $this->fields['QuantityInStock']['value'] = (int) $value;
        return $this;
    }

    public function getQuantityInStock ()
    {
        return $this->fields['QuantityInStock']['value'];
    }

    public function hasQuantityInStock ()
    {
        return !is_null($this->fields['QuantityInStock']['value']);
    }
}

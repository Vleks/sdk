<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model as BaseModel;
use Vleks\SDK\Entities\Price;

class OrderLine extends BaseModel
{
    public function __construct($data = null)
    {
        $this->fields = array (
                'Type'              => array ('value' => null, 'type' => 'string'),
                'OrderLineID'       => array ('value' => null, 'type' => 'string'),
                'VleksID'           => array ('value' => null, 'type' => 'string'),
                'SKU'               => array ('value' => null, 'type' => 'string'),
                'QuantityOrdered'   => array ('value' => null, 'type' => 'int'),
                'QuantityShipped'   => array ('value' => null, 'type' => 'int'),
                'ItemPrice'         => array ('value' => null, 'type' => Price::class),
                'Title'             => array ('value' => null, 'type' => 'string')
        );

        parent::__construct($data);
    }

    public function setType ($value)
    {
        $this->fields['Type']['value'] = $value;
        return $this;
    }

    public function getType ()
    {
        return $this->fields['Type']['value'];
    }

    public function hasType ()
    {
        return !is_null($this->fields['Type']['value']);
    }
    
    public function setOrderLineID ($value)
    {
        $this->fields['OrderLineID']['value'] = $value;
        return $this;
    }

    public function getOrderLineID ()
    {
        return $this->fields['OrderLineID']['value'];
    }

    public function hasOrderLineID ()
    {
        return !is_null($this->fields['OrderLineID']['value']);
    }
    
    public function setVleksID ($value)
    {
        $this->fields['VleksID']['value'] = $value;
        return $this;
    }

    public function getVleksID ()
    {
        return $this->fields['VleksID']['value'];
    }

    public function hasVleksID ()
    {
        return !is_null($this->fields['VleksID']['value']);
    }
    
    public function setSKU ($value)
    {
        $this->fields['SKU']['value'] = $value;
        return $this;
    }

    public function getSKU ()
    {
        return $this->fields['SKU']['value'];
    }

    public function hasSKU ()
    {
        return !is_null($this->fields['SKU']['value']);
    }

    public function setQuantityOrdered ($value)
    {
        $this->fields['QuantityOrdered']['value'] = (int) $value;
        return $this;
    }

    public function getQuantityOrdered ()
    {
        return $this->fields['QuantityOrdered']['value'];
    }

    public function hasQuantityOrdered ()
    {
        return !is_null($this->fields['QuantityOrdered']['value']);
    }

    public function setQuantityShipped ($value)
    {
        $this->fields['QuantityShipped']['value'] = (int) $value;
        return $this;
    }

    public function getQuantityShipped ()
    {
        return $this->fields['QuantityShipped']['value'];
    }

    public function hasQuantityShipped ()
    {
        return !is_null($this->fields['QuantityShipped']['value']);
    }

    public function setItemPrice ($value)
    {
        $this->fields['ItemPrice']['value'] = $value;
        return $this;
    }

    public function getItemPrice ()
    {
        return $this->fields['ItemPrice']['value'];
    }

    public function hasItemPrice ()
    {
        return !is_null($this->fields['ItemPrice']['value']);
    }

    public function setTitle ($value)
    {
        $this->fields['Title']['value'] = $value;
        return $this;
    }

    public function getTitle ()
    {
        return $this->fields['Title']['value'];
    }

    public function hasTitle ()
    {
        return !is_null($this->fields['Title']['value']);
    }
}

<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model as BaseModel;
use Vleks\SDK\Entities\AddressData;
use Vleks\SDK\Entities\Transport;
use Vleks\SDK\Entities\OrderLine;

class Shipment extends BaseModel
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'ShipmentID'      => array ('value' => null, 'type' => 'string'),
            'OrderID'         => array ('value' => null, 'type' => 'string'),
            'SendDate'        => array ('value' => null, 'type' => 'DateTime'),
            'Transport'       => array ('value' => null, 'type' => Transport::class),
            'Address'         => array ('value' => null, 'type' => AddressData::class),
            'OrderLines'      => array ('value' => array (), 'type' => array (OrderLine::class))                            
        );

        parent::__construct($data);
    }

    public function setShipmentID ($value)
    {
        $this->fields['ShipmentID']['value'] = $value;
        return $this;
    }

    public function getShipmentID ()
    {
        return $this->fields['ShipmentID']['value'];
    }

    public function hasShipmentID ()
    {
        return !is_null($this->fields['ShipmentID']['value']);
    }
    
    public function setOrderID ($value)
    {
        $this->fields['OrderID']['value'] = $value;
        return $this;
    }

    public function getOrderID ()
    {
        return $this->fields['OrderID']['value'];
    }

    public function hasOrderID ()
    {
        return !is_null($this->fields['OrderID']['value']);
    }
    
    public function setSendDate ($value)
    {
        $this->fields['SendDate']['value'] = $value;
        return $this;
    }

    public function getSendDate ()
    {
        return $this->fields['SendDate']['value'];
    }

    public function hasSendDate ()
    {
        return !is_null($this->fields['SendDate']['value']);
    }
    
    public function setTransport ($value)
    {
        $this->fields['Transport']['value'] = $value;
        return $this;
    }

    public function getTransport ()
    {
        return $this->fields['Transport']['value'];
    }

    public function hasTransport ()
    {
        return !is_null($this->fields['Transport']['value']);
    }
    
    public function setAddress ($value)
    {
        $this->fields['Address']['value'] = $value;
        return $this;
    }

    public function getAddress ()
    {
        return $this->fields['Address']['value'];
    }

    public function hasAddress ()
    {
        return !is_null($this->fields['Address']['value']);
    }
    
    public function setOrderLines ((array) $value)
    {
        $this->fields['OrderLines']['value'] = $value;
        return $this;
    }

    public function getOrderLines ()
    {
        return $this->fields['OrderLines']['value'];
    }

    public function hasOrderLines ()
    {
        return !empty($this->fields['OrderLines']['value']);
    }
}

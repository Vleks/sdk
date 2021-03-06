<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model as BaseModel;
use Vleks\SDK\Entities\AddressData;
use Vleks\SDK\Entities\Price;
use Vleks\SDK\Entities\OrderLine;

class Order extends BaseModel
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'OrderID'                   => array ('value' => null, 'type' => 'string'),
            'ReasonCode'                => array ('value' => 'OTHER', 'type' => 'string'),
            'PurchaseDate'              => array ('value' => null, 'type' => 'datetime'),
            'Status'                    => array ('value' => null, 'type' => 'string'),
            'ChannelID'                 => array ('value' => null, 'type' => 'string'),
            'IsBusinessOrder'           => array ('value' => null, 'type' => 'bool'),
            'IsFulfillmentOrder'        => array ('value' => null, 'type' => 'bool'),
            'BillingAddress'            => array ('value' => null, 'type' => AddressData::class),
            'ShippingAddress'           => array ('value' => null, 'type' => AddressData::class),
            'NumberOfShipments'         => array ('value' => null, 'type' => 'int'),
            'NumberOfItemsShipped'      => array ('value' => null, 'type' => 'int'),
            'NumberOfItemsUnshipped'    => array ('value' => null, 'type' => 'int'),
            'OrderTotal'                => array ('value' => null, 'type' => Price::class),
            'OrderLines'                => array ('value' => null, 'type' => OrderLines::class)
        );

        parent::__construct($data);
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

    public function setReasonCode ($value)
    {
        $this->fields['ReasonCode']['value'] = $value;
        return $this;
    }

    public function getReasonCode ()
    {
        return $this->fields['ReasonCode']['value'];
    }

    public function hasReasonCode ()
    {
        return !is_null($this->fields['ReasonCode']['value']);
    }

    public function setPurchaseDate ($value)
    {
        $this->fields['PurchaseDate']['value'] = $value;
        return $this;
    }

    public function getPurchaseDate ()
    {
        return $this->fields['PurchaseDate']['value'];
    }

    public function hasPurchaseDate ()
    {
        return !is_null($this->fields['PurchaseDate']['value']);
    }

    public function setStatus ($value)
    {
        $this->fields['Status']['value'] = $value;
        return $this;
    }

    public function getStatus ()
    {
        return $this->fields['Status']['value'];
    }

    public function hasStatus ()
    {
        return !is_null($this->fields['Status']['value']);
    }

    public function setChannelID ($value)
    {
        $this->fields['ChannelID']['value'] = $value;
        return $this;
    }

    public function getChannelID ()
    {
        return $this->fields['ChannelID']['value'];
    }

    public function hasChannelID ()
    {
        return !is_null($this->fields['ChannelID']['value']);
    }

    public function setIsBusinessOrder ($value)
    {
        $this->fields['IsBusinessOrder']['value'] = (bool) $value;
        return $this;
    }

    public function getIsBusinessOrder ()
    {
        return $this->fields['IsBusinessOrder']['value'];
    }

    public function hasIsBusinessOrder ()
    {
        return !is_null($this->fields['IsBusinessOrder']['value']);
    }

    public function setIsFulfillmentOrder ($value)
    {
        $this->fields['IsBusinessOrder']['value'] = (bool) $value;
        return $this;
    }

    public function getIsFulfillmentOrder ()
    {
        return $this->fields['IsBusinessOrder']['value'];
    }

    public function hasIsFulfillmentOrder ()
    {
        return !is_null($this->fields['IsBusinessOrder']['value']);
    }

    public function setBillingAddress ($value)
    {
        $this->fields['BillingAddress']['value'] = $value;
        return $this;
    }

    public function getBillingAddress ()
    {
        return $this->fields['BillingAddress']['value'];
    }

    public function hasBillingAddress ()
    {
        return !is_null($this->fields['BillingAddress']['value']);
    }

    public function setShippingAddress ($value)
    {
        $this->fields['ShippingAddress']['value'] = $value;
        return $this;
    }

    public function getShippingAddress ()
    {
        return $this->fields['ShippingAddress']['value'];
    }

    public function hasShippingAddress ()
    {
        return !is_null($this->fields['ShippingAddress']['value']);
    }

    public function setNumberOfShipments ($value)
    {
        $this->fields['NumberOfShipments']['value'] = (int) $value;
        return $this;
    }

    public function getNumberOfShipments ()
    {
        return $this->fields['NumberOfShipments']['value'];
    }

    public function hasNumberOfShipments ()
    {
        return !is_null($this->fields['NumberOfShipments']['value']);
    }

    public function setNumberOfItemsShipped ($value)
    {
        $this->fields['NumberOfItemsShipped']['value'] = (int) $value;
        return $this;
    }

    public function getNumberOfItemsShipped ()
    {
        return $this->fields['NumberOfItemsShipped']['value'];
    }

    public function hasNumberOfItemsShipped ()
    {
        return !is_null($this->fields['NumberOfItemsShipped']['value']);
    }

    public function setNumberOfItemsUnshipped ($value)
    {
        $this->fields['NumberOfItemsUnshipped']['value'] = (int) $value;
        return $this;
    }

    public function getNumberOfItemsUnshipped ()
    {
        return $this->fields['NumberOfItemsUnshipped']['value'];
    }

    public function hasNumberOfItemsUnshipped ()
    {
        return !is_null($this->fields['NumberOfItemsUnshipped']['value']);
    }

    public function setOrderTotal ($value)
    {
        $this->fields['OrderTotal']['value'] = $value;
        return $this;
    }

    public function getOrderTotal ()
    {
        return $this->fields['OrderTotal']['value'];
    }

    public function hasOrderTotal ()
    {
        return !is_null($this->fields['OrderTotal']['value']);
    }

    public function setOrderLines (array $value)
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

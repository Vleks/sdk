<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;

class Response extends Model
{
    /**
     * Construct new Vleks\SDK\Entities\Feed
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Message'    => array ('value' => null, 'type' => 'string'),
            'OrderID'    => array ('value' => null, 'type' => 'string'),
            'ShipmentID' => array ('value' => null, 'type' => 'string'),
            'VleksID'    => array ('value' => null, 'type' => 'string'),
            'RequestID'  => array ('value' => null, 'type' => 'string'),
            'SKU'        => array ('value' => null, 'type' => 'string'),
            'EAN'        => array ('value' => null, 'type' => 'string'),
            'Status'     => array ('value' => null, 'type' => 'string')
        );

        parent::__construct($data);
    }

    /**
     * Sets the value of the Message property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setMessage($value)
    {
        $this->fields['Message']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Message property
     *
     * @return  mixed   Message property value
     */
    public function getMessage()
    {
        return $this->fields['Message']['value'];
    }

    /**
     * Checks if the Message property has been set
     *
     * return   bool    True if the Message property has been set, false otherwise
     */
    public function hasMessage()
    {
        return !is_null($this->fields['Message']['value']);
    }

    /**
     * Sets the value of the OrderID property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setOrderID($value)
    {
        $this->fields['OrderID']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the OrderID property
     *
     * @return  mixed   OrderID property value
     */
    public function getOrderID()
    {
        return $this->fields['OrderID']['value'];
    }

    /**
     * Checks if the OrderID property has been set
     *
     * return   bool    True if the OrderID property has been set, false otherwise
     */
    public function hasOrderID()
    {
        return !is_null($this->fields['OrderID']['value']);
    }

    /**
     * Sets the value of the ShipmentID property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setShipmentID($value)
    {
        $this->fields['ShipmentID']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the ShipmentID property
     *
     * @return  mixed   ShipmentID property value
     */
    public function getShipmentID()
    {
        return $this->fields['ShipmentID']['value'];
    }

    /**
     * Checks if the ShipmentID property has been set
     *
     * return   bool    True if the ShipmentID property has been set, false otherwise
     */
    public function hasShipmentID()
    {
        return !is_null($this->fields['ShipmentID']['value']);
    }

    /**
     * Sets the value of the VleksID property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setVleksID($value)
    {
        $this->fields['VleksID']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the VleksID property
     *
     * @return  mixed   VleksID property value
     */
    public function getVleksID()
    {
        return $this->fields['VleksID']['value'];
    }

    /**
     * Checks if the RequestID property has been set
     *
     * return   bool    True if the RequestID property has been set, false otherwise
     */
    public function hasVleksID()
    {
        return !is_null($this->fields['VleksID']['value']);
    }

    /**
     * Sets the value of the RequestID property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setRequestID($value)
    {
        $this->fields['RequestID']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the RequestID property
     *
     * @return  mixed   RequestID property value
     */
    public function getRequestID()
    {
        return $this->fields['RequestID']['value'];
    }

    /**
     * Checks if the RequestID property has been set
     *
     * return   bool    True if the RequestID property has been set, false otherwise
     */
    public function hasRequestID()
    {
        return !is_null($this->fields['RequestID']['value']);
    }

    /**
     * Sets the value of the SKU property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setSKU($value)
    {
        $this->fields['SKU']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the SKU property
     *
     * @return  mixed   SKU property value
     */
    public function getSKU()
    {
        return $this->fields['SKU']['value'];
    }

    /**
     * Checks if the SKU property has been set
     *
     * return   bool    True if the SKU property has been set, false otherwise
     */
    public function hasSKU()
    {
        return !is_null($this->fields['SKU']['value']);
    }

    /**
     * Sets the value of the EAN property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setEAN($value)
    {
        $this->fields['EAN']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the EAN property
     *
     * @return  mixed   EAN property value
     */
    public function getEAN()
    {
        return $this->fields['EAN']['value'];
    }

    /**
     * Checks if the EAN property has been set
     *
     * return   bool    True if the EAN property has been set, false otherwise
     */
    public function hasEAN()
    {
        return !is_null($this->fields['EAN']['value']);
    }

    /**
     * Sets the value of the Status property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setStatus($value)
    {
        $this->fields['Status']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Status property
     *
     * @return  mixed   Status property value
     */
    public function getStatus()
    {
        return $this->fields['Status']['value'];
    }

    /**
     * Checks if the Status property has been set
     *
     * return   bool    True if the Status property has been set, false otherwise
     */
    public function hasStatus()
    {
        return !is_null($this->fields['Status']['value']);
    }
}

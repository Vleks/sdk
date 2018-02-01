<?php namespace Vleks\SDK\Requests;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\Shipment;

class AddShipments extends Model
{
    /**
     * Construct new Vleks\SDK\Requests\AddShipments
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Shipment'  => array ('value' => array (), 'type' => array(Shipment::class))
        );

        parent::__construct($data);
    }

    /**
     * Sets the value of the Shipment property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setShipment(array $value)
    {
        $this->fields['Shipment']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Shipment property
     *
     * @return  mixed   Shipment property value
     */
    public function getShipment()
    {
        return $this->fields['Shipment']['value'];
    }

    /**
     * Checks if the Shipment property has been set
     *
     * @return  bool    True if the Shipment property has been set, false otherwise
     */
    public function hasShipment()
    {
        return !is_null($this->fields['Shipment']['value']);
    }

    /**
     * Helper methods for convenience
     */
    public function setShipments(array $value)
    {
        return $this->setShipment($value);
    }

    public function getShipments()
    {
        return $this->getShipment();
    }

    public function hasShipments()
    {
        return $this->hasShipment();
    }
}

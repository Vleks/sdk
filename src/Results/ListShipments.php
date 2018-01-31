<?php namespace Vleks\SDK\Results;

use \DOMXPath;
use \DOMDocument;
use Vleks\SDK\Model;
use Vleks\SDK\Entities\Shipment;
use Vleks\SDK\Exceptions\ClientException;

class ListShipments extends Model
{
    /**
     * Construct new Vleks\SDK\Results\ListShipments
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Shipment'        => array ('value' => array (), 'type' => array (Shipment::class)),
            'ResponseHeaders' => array ('value' => array (), 'type' => 'array')
        );

        parent::__construct($data);
    }

    /**
     * Construct new Vleks\SDK\Results\ListShipments from XML string
     *
     * @param   string  $xml
     * @return  object  Vleks\SDK\Results\ListShipments
     * @throws  Vleks\SDK\Exceptions\ClientException
     */
    public function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $xpath    = new DOMXPath($dom);
        $response = $xpath->query('//VleksResponse');

        if (1 === $response->length) {
            return new ListShipments($response->item(0));
        } else {
            throw new ClientException('Unable to construct ListShipments response from provided XML.');
        }
    }

    /**
     * Sets the value of the Order property
     *
     * @param   array   $value
     * @return  this instance
     */
    public function setShipment(array $value)
    {
        $this->fields['Shipment']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Order property
     *
     * @return  array   Product property value
     */
    public function getShipment()
    {
        return $this->fields['Shipment']['value'];
    }

    /**
     * Checks if the Shipment property has been set
     *
     * @return  bool    True if the Product property has been set, false otherwise
     */
    public function hasShipment()
    {
        return !empty($this->fields['Shipment']['value']);
    }

    /**
     * Sets the ResponseHeaders property
     *
     * @param   array   $value
     * @return  this instance
     */
    public function setResponseHeaders(array $value)
    {
        $this->fields['ResponseHeaders']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the ResponseHeaders property
     *
     * @return  array   ResponseHeaders property value
     */
    public function getResponseHeaders()
    {
        return $this->fields['ResponseHeaders']['value'];
    }

    /**
     * Checks if the ResponseHeaders property had been set
     *
     * @return  bool    True if the ResponseHeaders property has been set, false otherwise
     */
    public function hasResponseHeaders()
    {
        return !empty($this->fields['ResponseHeaders']['value']);
    }

    /**
     * Shipment property method aliasses for convenience
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

<?php namespace Vleks\SDK\Results;

use \DOMXPath;
use \DOMDocument;
use Vleks\SDK\Model;
use Vleks\SDK\Entities\Order;
use Vleks\SDK\Exceptions\ClientException;

class ListOrders extends Model
{
    /**
     * Construct new Vleks\SDK\Results\ListOrders
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Order'           => array ('value' => array (), 'type' => array(Order::class)),
            'ResponseHeaders' => array ('value' => array (), 'type' => 'array')
        );

        parent::__construct($data);
    }

    /**
     * Construct new Vleks\SDK\Results\ListOrders from XML string
     *
     * @param   string  $xml
     * @return  object  Vleks\SDK\Results\ListOrders
     * @throws  Vleks\SDK\Exceptions\ClientException
     */
    public function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $xpath    = new DOMXPath($dom);
        $response = $xpath->query('//VleksResponse');

        if (1 === $response->length) {
            return new ListOrders($response->item(0));
        } else {
            throw new ClientException('Unable to construct ListOrders response from provided XML.');
        }
    }

    /**
     * Sets the value of the Order property
     *
     * @param   array   $value
     * @return  this instance
     */
    public function setOrder(array $value)
    {
        $this->fields['Order']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Order property
     *
     * @return  array   Product property value
     */
    public function getOrder()
    {
        return $this->fields['Order']['value'];
    }

    /**
     * Checks if the Order property has been set
     *
     * @return  bool    True if the Product property has been set, false otherwise
     */
    public function hasOrder()
    {
        return !empty($this->fields['Order']['value']);
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
     * Order property method aliasses for convenience
     */
    public function setOrders(array $value)
    {
        return $this->setOrder($value);
    }

    public function getOrders()
    {
        return $this->getOrder();
    }

    public function hasOrders()
    {
        return $this->hasOrder();
    }
}

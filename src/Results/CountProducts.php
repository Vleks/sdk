<?php namespace Vleks\SDK\Results;

use \DOMXPath;
use \DOMDocument;
use Vleks\SDK\Model;
use Vleks\SDK\Entities\Count;
use Vleks\SDK\Exceptions\ClientException;

class CountProducts extends Model
{
    /**
     * Construct new Vleks\SDK\Results\CountProducts
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Count'           => array ('value' => null, 'type' => Count::class),
            'ResponseHeaders' => array ('value' => array (), 'type' => 'array')
        );

        parent::__construct($data);
    }

    /**
     * Construct new Vleks\SDK\Results\ListProducts from XML string
     *
     * @param   string  $xml
     * @return  object  Vleks\SDK\Results\CountProducts
     * @throws  Vleks\SDK\Exceptions\ClientException
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $xpath    = new DOMXPath($dom);
        $response = $xpath->query('//VleksResponse');

        if (1 === $response->length) {
            return new CountProducts($response->item(0));
        } else {
            throw new ClientException('Unable to construct CountProducts response from provided XML.');
        }
    }

    /**
     * Sets the value of the Count property
     *
     * @param   array   $value
     * @return  this instance
     */
    public function setCount($value)
    {
        $this->fields['Count']['value'] = (int) $value;
        return $this;
    }

    /**
     * Gets the value of the Count property
     *
     * @return  array   Product property value
     */
    public function getCount()
    {
        return $this->fields['Count']['value'];
    }

    /**
     * Checks if the Count property has been set
     *
     * @return  bool    True if the Product property has been set, false otherwise
     */
    public function hasCount()
    {
        return !is_null($this->fields['Count']['value']);
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
}

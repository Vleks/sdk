<?php namespace Vleks\SDK\Results;

use \DOMXPath;
use \DOMDocument;
use Vleks\SDK\Model;
use Vleks\SDK\Entities\Product;
use Vleks\SDK\Exceptions\ClientException;

class ListProducts extends Model
{
    /**
     * Construct new Vleks\SDK\Results\ListProducts
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Product'         => array ('value' => array (), 'type' => array(Product::class)),
            'ResponseHeaders' => array ('value' => array (), 'type' => 'array')
        );

        parent::__construct($data);
    }

    /**
     * Construct new Vleks\SDK\Results\ListProducts from XML string
     *
     * @param   string  $xml
     * @return  object  Vleks\SDK\Results\ListProducts
     * @throws  Vleks\SDK\Exceptions\ClientException
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $xpath    = new DOMXPath($dom);
        $response = $xpath->query('//VleksResponse');

        if (1 === $response->length) {
            return new ListProducts($response->item(0));
        } else {
            throw new ClientException('Unable to construct ListProducts response from provided XML.');
        }
    }

    /**
     * Sets the value of the Product property
     *
     * @param   array   $value
     * @return  this instance
     */
    public function setProduct(array $value)
    {
        $this->fields['Product']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Product property
     *
     * @return  array   Product property value
     */
    public function getProduct()
    {
        return $this->fields['Product']['value'];
    }

    /**
     * Checks if the Product property has been set
     *
     * @return  bool    True if the Product property has been set, false otherwise
     */
    public function hasProduct()
    {
        return !empty($this->fields['Product']['value']);
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
     * Product property method aliasses for convenience
     */
    public function setProducts(array $value)
    {
        return $this->setProduct($value);
    }

    public function getProducts()
    {
        return $this->getProduct();
    }

    public function hasProducts()
    {
        return $this->hasProduct();
    }
}

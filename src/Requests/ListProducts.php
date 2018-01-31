<?php namespace Vleks\SDK\Requests;

use Vleks\SDK\Model;
use Vleks\SDK\Exceptions;
use Vleks\SDK\Entities\Product;

class ListProducts extends Model
{
    /**
     * Construct new Vleks\SDK\Requests\ListProducts
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Limit'   => array ('value' => null, 'type' => 'int'),
            'Offset'  => array ('value' => null, 'type' => 'int'),
            'Product' => array ('value' => array(), 'type' => array(Product::class))
        );

        parent::__construct($data);
    }

    /**
     * Sets the value of the Limit property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setLimit($value)
    {
        $value = (int) $value;

        if ($value > 100) {
            throw new Exceptions\ClientException('Given limit exceeds the limit of 1000 results.');
        }

        $this->fields['Limit']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Limit property
     *
     * @return  mixed   Limit property value
     */
    public function getLimit()
    {
        return $this->fields['Limit']['value'];
    }

    /**
     * Checks if the Limit property has been set
     *
     * return   bool    True if the Limit property has been set, false otherwise
     */
    public function hasLimit()
    {
        return !is_null($this->fields['Limit']['value']);
    }

    /**
     * Sets the value of the Offset property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setOffset($value)
    {
        $this->fields['Offset']['value'] = (int) $value;
        return $this;
    }

    /**
     * Gets the value of the Offset property
     *
     * @return  mixed   Offset property value
     */
    public function getOffset()
    {
        return $this->fields['Offset']['value'];
    }

    /**
     * Checks if the Offset property has been set
     *
     * @return  bool    True if the Offset property has been set, false otherwise
     */
    public function hasOffset()
    {
        return !is_null($this->fields['Offset']['value']);
    }

    /**
     * Sets the value of the Product property
     *
     * @param   int     $value
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
     * @return  mixed   Product property value
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
        return !is_null($this->fields['Product']['value']);
    }

    /**
     * Helper methods for convenience
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

<?php namespace Vleks\SDK\Requests;

use Vleks\SDK\Model;
use Vleks\SDK\Exceptions;
use Vleks\SDK\Entities\Product;

class UpdateProducts extends Model
{
    /**
     * Construct new Vleks\SDK\Requests\UpdateProducts
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Product' => array ('value' => array(), 'type' => array(Product::class))
        );

        parent::__construct($data);
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

<?php namespace Vleks\SDK\Requests;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\Order;

class FinishOrders extends Model
{
    /**
     * Construct new Vleks\SDK\Requests\FinishOrders
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Order' => array ('value' => array(), 'type' => array(Order::class))
        );

        parent::__construct($data);
    }

    /**
     * Sets the value of the Order property
     *
     * @param   int     $value
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
     * @return  mixed   Order property value
     */
    public function getOrder()
    {
        return $this->fields['Order']['value'];
    }

    /**
     * Checks if the Order property has been set
     *
     * return   bool    True if the Order property has been set, false otherwise
     */
    public function hasOrder()
    {
        return !empty($this->fields['Order']['value']);
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

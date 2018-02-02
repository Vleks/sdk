<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\OrderLine;

class OrderLines extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'OrderLine' => array ('value' => array(), 'type' => array(OrderLine::class))
        );

        parent::__construct($data);
    }

    public function setOrderLine (array $value)
    {
        $this->fields['OrderLine']['value'] = $value;
        return $this;
    }

    public function getOrderLine ()
    {
        return $this->fields['OrderLine']['value'];
    }

    public function hasOrderLine ()
    {
        return !empty($this->fields['OrderLine']['value']);
    }

    public function setOrderLines (array $value)
    {
        return $this->setOrderLine($value);
    }

    public function getOrderLines ()
    {
        return $this->getOrderLine();
    }

    public function hasOrderLines ()
    {
        return $this->hasOrderLine();
    }
}

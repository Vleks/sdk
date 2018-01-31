<?php namespace Vleks\SDK\Requests;

use Vleks\SDK\Model as BaseModel;
use Vleks\SDK\Exceptions;

class ListOrders extends BaseModel
{
    /**
     * Construct new Vleks\SDK\Requests\ListOrders
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Limit'  => array ('value' => null, 'type' => 'int'),
            'Offset' => array ('value' => null, 'type' => 'int')
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
            throw new Exceptions\ClientException('Given limit exceeds the limit of 100 results.');
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
}

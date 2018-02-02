<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;

class Feed extends Model
{
    /**
     * Construct new Vleks\SDK\Entities\Feed
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'RequestID' => array ('value' => null, 'type' => 'string'),
            'StatusID'  => array ('value' => null, 'type' => 'string'),
            'Status'    => array ('value' => null, 'type' => 'string')
        );

        parent::__construct($data);
    }

    /**
     * Sets the value of the RequestID property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setRequestID($value)
    {
        $this->fields['RequestID']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the RequestID property
     *
     * @return  mixed   RequestID property value
     */
    public function getRequestID()
    {
        return $this->fields['RequestID']['value'];
    }

    /**
     * Checks if the RequestID property has been set
     *
     * return   bool    True if the RequestID property has been set, false otherwise
     */
    public function hasRequestID()
    {
        return !is_null($this->fields['RequestID']['value']);
    }

    /**
     * Sets the value of the StatusID property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setStatusID($value)
    {
        $this->fields['StatusID']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the StatusID property
     *
     * @return  mixed   StatusID property value
     */
    public function getStatusID()
    {
        return $this->fields['StatusID']['value'];
    }

    /**
     * Checks if the StatusID property has been set
     *
     * return   bool    True if the Limit property has been set, false otherwise
     */
    public function hasStatusID()
    {
        return !is_null($this->fields['StatusID']['value']);
    }

    /**
     * Sets the value of the Status property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setStatus($value)
    {
        $this->fields['Status']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Status property
     *
     * @return  mixed   Status property value
     */
    public function getStatus()
    {
        return $this->fields['Status']['value'];
    }

    /**
     * Checks if the Status property has been set
     *
     * return   bool    True if the Status property has been set, false otherwise
     */
    public function hasStatus()
    {
        return !is_null($this->fields['Status']['value']);
    }
}

<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;

class Attribute extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'Property' => array ('value' => null, 'type' => 'string'),
            'Value'    => array ('value' => null, 'type' => 'string')
        );

        parent::__construct($data);
    }

    public function setProperty ($value)
    {
        $this->fields['Property']['value'] = $value;
        return $this;
    }

    public function getProperty ()
    {
        return $this->fields['Property']['value'];
    }

    public function hasProperty ()
    {
        return !is_null($this->fields['Property']['value']);
    }

    public function setValue ($value)
    {
        $this->fields['Value']['value'] = $value;
        return $this;
    }

    public function getValue ()
    {
        return $this->fields['Value']['value'];
    }

    public function hasValue ()
    {
        return !is_null($this->fields['Value']['value']);
    }
}

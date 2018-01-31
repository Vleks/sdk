<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\Attribute;

class AttributeList extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'Attribute' => array ('value' => array(), 'type' => array(Attribute::class))
        );
    }

    public function setAttribute (array $value)
    {
        $this->fields['Attribute']['value'] = $value;
        return $this;
    }

    public function getAttribute ()
    {
        return $this->fields['Attribute']['value'];
    }

    public function hasAttribute ()
    {
        return !is_null($this->fields['Attribute']['value']);
    }

    public function setAttributes (array $value)
    {
        return $this->setAttribute($value);
    }

    public function getAttributes ()
    {
        return $this->getAttribute();
    }

    public function hasAttributes ()
    {
        return $this->hasAttribute();
    }
}

<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\Attribute;

class AttributesList extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'Attribute' => array ('value' => array(), 'type' => array(Attribute::class))
        );

        parent::__construct($data);
    }

    public function setAttribute(array $value)
    {
        $this->fields['Attribute']['value'] = $value;
        return $this;
    }

    public function getAttribute()
    {
        return $this->fields['Attribute']['value'];
    }

    public function hasAttribute()
    {
        return !empty($this->fields['Attribute']['value']);
    }

    public function setAttributes(array $value)
    {
        return $this->setAttribute($value);
    }

    public function getAttributes()
    {
        return $this->getAttribute();
    }

    public function hasAttributes()
    {
        return $this->hasAttribute();
    }
}

<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;

class EANList extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'EAN' => array ('value' => array(), 'type' => array('string'))
        );

        parent::__construct($data);
    }

    public function setEAN (array $value)
    {
        $this->fields['EAN']['value'] = $value;
        return $this;
    }

    public function getEAN ()
    {
        return $this->fields['EAN']['value'];
    }

    public function hasEAN ()
    {
        return !is_null($this->fields['EAN']['value']);
    }
}

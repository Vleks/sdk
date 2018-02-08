<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;

class Count extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'Result' => array ('value' => null, 'type' => 'int')
        );

        parent::__construct($data);
    }

    public function setResult ($value)
    {
        $this->fields['Result']['value'] = $value;
        return $this;
    }

    public function getResult ()
    {
        return $this->fields['Result']['value'];
    }

    public function hasResult ()
    {
        return !is_null($this->fields['Result']['value']);
    }
}

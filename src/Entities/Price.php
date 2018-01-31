<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;

class Price extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'Currency' => array ('value' => null, 'type' => 'string'),
            'Amount'   => array ('value' => null, 'type' => 'float')
        );

        parent::__construct($data);
    }

    public function setCurrency ($value)
    {
        $this->fields['Currency']['value'] = $value;
        return $this;
    }

    public function getCurrency ()
    {
        return $this->fields['Currency']['value'];
    }

    public function hasCurrency ()
    {
        return !is_null($this->fields['Currency']['value']);
    }

    public function setAmount ($value)
    {
        $this->fields['Amount']['value'] = $value;
        return $this;
    }

    public function getAmount ()
    {
        return $this->fields['Amount']['value'];
    }

    public function hasAmount ()
    {
        return !is_null($this->fields['Amount']['value']);
    }
}

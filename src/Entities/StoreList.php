<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\Store;

class StoreList extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'StoreID' => array ('value' => array(), 'type' => array('string'))
        );

        parent::__construct($data);
    }

    public function setStoreID (array $value)
    {
        $this->fields['StoreID']['value'] = $value;
        return $this;
    }

    public function getStoreID ()
    {
        return $this->fields['StoreID']['value'];
    }

    public function hasStoreID ()
    {
        return !is_null($this->fields['StoreID']['value']);
    }

    public function setStoreIDs (array $value)
    {
        return $this->setStoreID($value);
    }

    public function getStoreIDs ()
    {
        return $this->getStoreID();
    }

    public function hasStoreIDs ()
    {
        return $this->hasStoreID();
    }
}

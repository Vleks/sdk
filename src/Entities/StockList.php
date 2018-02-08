<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\StockLocation;

class Stocklist extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array(
            'StockLocation' => array ('value' => array(), 'type' => array(StockLocation::class))
        );

        parent::__construct($data);
    }

    public function setStockLocation (array $value)
    {
        $this->fields['StockLocation']['value'] = $value;
        return $this;
    }

    public function getStockLocation ()
    {
        return $this->fields['StockLocation']['value'];
    }

    public function hasStockLocation ()
    {
        return !empty($this->fields['StockLocation']['value']);
    }
}

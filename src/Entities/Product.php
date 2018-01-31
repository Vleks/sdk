<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\EANList;
use Vleks\SDK\Entities\AttributesList;
use Vleks\SDK\Entities\StockList;
use Vleks\SDK\Entities\StoreList;
use Vleks\SDK\Entities\Price;
use Vleks\SDK\Entities\PriceAndPercentage;

class Product extends Model
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'VleksID'         => array ('value' => null, 'type' => 'string'),
            'SKU'             => array ('value' => null, 'type' => 'string'),
            'EANList'         => array ('value' => array(), 'type' => array(EANList::class)),
            'Condition'       => array ('value' => null, 'type' => 'string'),
            'Reference'       => array ('value' => null, 'type' => 'string'),
            'MinDeliveryTime' => array ('value' => null, 'type' => 'int'),
            'MaxDeliveryTime' => array ('value' => null, 'type' => 'int'),
            'PurchasePrice'   => array ('value' => null, 'type' => Price::class),
            'Marge'           => array ('value' => null, 'type' => PriceAndPercentage::class),
            'OverheadCosts'   => array ('value' => null, 'type' => PriceAndPercentage::class),
            'HandlingCosts'   => array ('value' => null, 'type' => PriceAndPercentage::class),
            'StorageCosts'    => array ('value' => null, 'type' => PriceAndPercentage::class),
            'MarketingCosts'  => array ('value' => null, 'type' => PriceAndPercentage::class),
            'MinPrice'        => array ('value' => null, 'type' => Price::class),
            'MaxPrice'        => array ('value' => null, 'type' => Price::class),
            'SalePrice'       => array ('value' => null, 'type' => Price::class),
            'OfferPrice'      => array ('value' => null, 'type' => Price::class),
            'Title'           => array ('value' => null, 'type' => 'string'),
            'Brand'           => array ('value' => null, 'type' => 'string'),
            'ItemType'        => array ('value' => null, 'type' => 'string'),
            'Description'     => array ('value' => null, 'type' => 'string'),
            'Active'          => array ('value' => null, 'type' => 'bool'),
            'Height'          => array ('value' => null, 'type' => 'int'),
            'Width'           => array ('value' => null, 'type' => 'int'),
            'Length'          => array ('value' => null, 'type' => 'int'),
            'Weight'          => array ('value' => null, 'type' => 'int'),
            'TaxPercentage'   => array ('value' => null, 'type' => 'string'),
            'Attributes'      => array ('value' => array(), 'type' => array(AttributesList::class)),
            'Stock'           => array ('value' => array(), 'type' => array(StockList::class)),
            'Store'           => array ('value' => array(), 'type' => array(StoreList::class))
        );

        parent::__construct($data);
    }

    public function setVleksID ($value)
    {
        $this->fields['VleksID']['value'] = $value;
        return $this;
    }

    public function getVleksID ()
    {
        return $this->fields['VleksID']['value'];
    }

    public function hasVleksID ()
    {
        return !is_null($this->fields['VleksID']['value']);
    }

    public function setSKU ($value)
    {
        $this->fields['SKU']['value'] = $value;
        return $this;
    }

    public function getSKU ()
    {
        return $this->fields['SKU']['value'];
    }

    public function hasSKU ()
    {
        return !is_null($this->fields['SKU']['value']);
    }

    public function setEANList ($value)
    {
        $this->fields['EANList']['value'] = $value;
        return $this;
    }

    public function getEANList ()
    {
        return $this->fields['EANList']['value'];
    }

    public function hasEANList ()
    {
        return !is_null($this->fields['EANList']['value']);
    }

    public function setCondition ($value)
    {
        $this->fields['Condition']['value'] = $value;
        return $this;
    }

    public function getCondition ()
    {
        return $this->fields['Condition']['value'];
    }

    public function hasCondition ()
    {
        return !is_null($this->fields['Condition']['value']);
    }

    public function setReference ($value)
    {
        $this->fields['Reference']['value'] = $value;
        return $this;
    }

    public function getReference ()
    {
        return $this->fields['Reference']['value'];
    }

    public function hasReference ()
    {
        return !is_null($this->fields['Reference']['value']);
    }

    public function setMinDeliveryTime ($value)
    {
        $this->fields['MinDeliveryTime']['value'] = $value;
        return $this;
    }

    public function getMinDeliveryTime ()
    {
        return $this->fields['MinDeliveryTime']['value'];
    }

    public function hasMinDeliveryTime ()
    {
        return !is_null($this->fields['MinDeliveryTime']['value']);
    }

    public function setMaxDeliveryTime ($value)
    {
        $this->fields['MaxDeliveryTime']['value'] = $value;
        return $this;
    }

    public function getMaxDeliveryTime ()
    {
        return $this->fields['MaxDeliveryTime']['value'];
    }

    public function hasMaxDeliveryTime ()
    {
        return !is_null($this->fields['MaxDeliveryTime']['value']);
    }

    public function setPurchasePrice ($value)
    {
        $this->fields['PurchasePrice']['value'] = $value;
        return $this;
    }

    public function getPurchasePrice ()
    {
        return $this->fields['PurchasePrice']['value'];
    }

    public function hasPurchasePrice ()
    {
        return !is_null($this->fields['PurchasePrice']['value']);
    }

    public function setMarge ($value)
    {
        $this->fields['Marge']['value'] = $value;
        return $this;
    }

    public function getMarge ()
    {
        return $this->fields['Marge']['value'];
    }

    public function hasMarge ()
    {
        return !is_null($this->fields['Marge']['value']);
    }

    public function setOverheadCosts ($value)
    {
        $this->fields['OverheadCosts']['value'] = $value;
        return $this;
    }

    public function getOverheadCosts ()
    {
        return $this->fields['OverheadCosts']['value'];
    }

    public function hasOverheadCosts ()
    {
        return !is_null($this->fields['OverheadCosts']['value']);
    }

    public function setHandlingCosts ($value)
    {
        $this->fields['HandlingCosts']['value'] = $value;
        return $this;
    }

    public function getHandlingCosts ()
    {
        return $this->fields['HandlingCosts']['value'];
    }

    public function hasHandlingCosts ()
    {
        return !is_null($this->fields['HandlingCosts']['value']);
    }

    public function setStorageCosts ($value)
    {
        $this->fields['StorageCosts']['value'] = $value;
        return $this;
    }

    public function getStorageCosts ()
    {
        return $this->fields['StorageCosts']['value'];
    }

    public function hasStorageCosts ()
    {
        return !is_null($this->fields['StorageCosts']['value']);
    }

    public function setMarketingCosts ($value)
    {
        $this->fields['MarketingCosts']['value'] = $value;
        return $this;
    }

    public function getMarketingCosts ()
    {
        return $this->fields['MarketingCosts']['value'];
    }

    public function hasMarketingCosts ()
    {
        return !is_null($this->fields['MarketingCosts']['value']);
    }

    public function setMinPrice ($value)
    {
        $this->fields['MinPrice']['value'] = $value;
        return $this;
    }

    public function getMinPrice ()
    {
        return $this->fields['MinPrice']['value'];
    }

    public function hasMinPrice ()
    {
        return !is_null($this->fields['MinPrice']['value']);
    }

    public function setMaxPrice ($value)
    {
        $this->fields['MaxPrice']['value'] = $value;
        return $this;
    }

    public function getMaxPrice ()
    {
        return $this->fields['MaxPrice']['value'];
    }

    public function hasMaxPrice ()
    {
        return !is_null($this->fields['MaxPrice']['value']);
    }

    public function setSalePrice ($value)
    {
        $this->fields['SalePrice']['value'] = $value;
        return $this;
    }

    public function getSalePrice ()
    {
        return $this->fields['SalePrice']['value'];
    }

    public function hasSalePrice ()
    {
        return !is_null($this->fields['SalePrice']['value']);
    }

    public function setOfferPrice ($value)
    {
        $this->fields['OfferPrice']['value'] = $value;
        return $this;
    }

    public function getOfferPrice ()
    {
        return $this->fields['OfferPrice']['value'];
    }

    public function hasOfferPrice ()
    {
        return !is_null($this->fields['OfferPrice']['value']);
    }

    public function setTitle ($value)
    {
        $this->fields['Title']['value'] = $value;
        return $this;
    }

    public function getTitle ()
    {
        return $this->fields['Title']['value'];
    }

    public function hasTitle ()
    {
        return !is_null($this->fields['Title']['value']);
    }

    public function setBrand ($value)
    {
        $this->fields['Brand']['value'] = $value;
        return $this;
    }

    public function getBrand ()
    {
        return $this->fields['Brand']['value'];
    }

    public function hasBrand ()
    {
        return !is_null($this->fields['Brand']['value']);
    }

    public function setItemType ($value)
    {
        $this->fields['ItemType']['value'] = $value;
        return $this;
    }

    public function getItemType ()
    {
        return $this->fields['ItemType']['value'];
    }

    public function hasItemType ()
    {
        return !is_null($this->fields['ItemType']['value']);
    }

    public function setDescription ($value)
    {
        $this->fields['Description']['value'] = $value;
        return $this;
    }

    public function getDescription ()
    {
        return $this->fields['Description']['value'];
    }

    public function hasDescription ()
    {
        return !is_null($this->fields['Description']['value']);
    }

    public function setActive ($value)
    {
        $this->fields['Active']['value'] = $value;
        return $this;
    }

    public function getActive ()
    {
        return $this->fields['Active']['value'];
    }

    public function hasActive ()
    {
        return !is_null($this->fields['Active']['value']);
    }

    public function setHeight ($value)
    {
        $this->fields['Height']['value'] = $value;
        return $this;
    }

    public function getHeight ()
    {
        return $this->fields['Height']['value'];
    }

    public function hasHeight ()
    {
        return !is_null($this->fields['Height']['value']);
    }

    public function setWidth ($value)
    {
        $this->fields['Width']['value'] = $value;
        return $this;
    }

    public function getWidth ()
    {
        return $this->fields['Width']['value'];
    }

    public function hasWidth ()
    {
        return !is_null($this->fields['Width']['value']);
    }

    public function setLength ($value)
    {
        $this->fields['Length']['value'] = $value;
        return $this;
    }

    public function getLength ()
    {
        return $this->fields['Length']['value'];
    }

    public function hasLength ()
    {
        return !is_null($this->fields['Length']['value']);
    }

    public function setWeight ($value)
    {
        $this->fields['Weight']['value'] = $value;
        return $this;
    }

    public function getWeight ()
    {
        return $this->fields['Weight']['value'];
    }

    public function hasWeight ()
    {
        return !is_null($this->fields['Weight']['value']);
    }

    public function setTaxPercentage ($value)
    {
        $this->fields['TaxPercentage']['value'] = $value;
        return $this;
    }

    public function getTaxPercentage ()
    {
        return $this->fields['TaxPercentage']['value'];
    }

    public function hasTaxPercentage ()
    {
        return !is_null($this->fields['TaxPercentage']['value']);
    }

    public function setAttributes ($value)
    {
        $this->fields['Attributes']['value'] = $value;
        return $this;
    }

    public function getAttributes ()
    {
        return $this->fields['Attributes']['value'];
    }

    public function hasAttributes ()
    {
        return !is_null($this->fields['Attributes']['value']);
    }

    public function setStock ($value)
    {
        $this->fields['Stock']['value'] = $value;
        return $this;
    }

    public function getStock ()
    {
        return $this->fields['Stock']['value'];
    }

    public function hasStock ()
    {
        return !is_null($this->fields['Stock']['value']);
    }

    public function setStore ($value)
    {
        $this->fields['Store']['value'] = $value;
        return $this;
    }

    public function getStore ()
    {
        return $this->fields['Store']['value'];
    }

    public function hasStore ()
    {
        return !is_null($this->fields['Store']['value']);
    }
}

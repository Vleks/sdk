<?php

use PHPUnit\Framework\TestCase;
use Vleks\SDK\Entities;

class EntityTest extends TestCase
{
    public function entityTestLoop ($entity, $individual_fields = null, $entity_fields = null)
    {
        if(!is_null($individual_fields)) {
            $class = new $entity();
            
            foreach ($individual_fields as $propertyName => $value) {
                // Setter & Getter & Has
                $setMethod = 'set' . $propertyName;
                $getMethod = 'get' . $propertyName;
                $hasMethod = 'has' . $propertyName;
                
                // Test individual methods
                $class->$setMethod($value);
                $this->assertTrue($class->$hasMethod());
                $this->assertEquals($class->$getMethod(), $value);
                $this->assertEquals($class->$propertyName, $value);
            }
            
            // Test direct creation of entity
            $class = new $entity($individual_fields);
            
            foreach ($individual_fields as $propertyName => $value) {
                $hasMethod = 'has' . $propertyName;
                
                $this->assertTrue($class->$hasMethod());
                $this->assertEquals($class->$propertyName, $value);
            }
        }

        if(!is_null($entity_fields)) {
             foreach ($entity_fields as $entity_name => $entityFields) {
                $class = new $entity();
                    
                // Setter & Getter & Has 
                $setMethod = 'set' . $entity_name;
                $getMethod = 'get' . $entity_name;
                $hasMethod = 'has' . $entity_name;
                 
                // Test nested entities
                $this->assertFalse($class->$hasMethod());
                $class->$setMethod($entityFields);
                $this->assertTrue($class->$hasMethod());
                $this->assertInternalType('array', $class->$getMethod());
            }   
        }        
    }
    
    public function testAddressData()
    {
        $entity = Entities\AddressData::class;

        $individual_fields = array(
            'SalutationCode'    => 'testValue',
            'Firstname'         => 'testValue',
            'Surname'           => 'testValue',
            'StreetName'        => 'testValue',
            'HouseNumber'       => 'testValue',
            'PostalCode'        => 'testValue',
            'City'              => 'testValue',
            'Email'             => 'testValue'
        );
        
        $entity_fields = array(
            'Company' => array('CompanyName' => 'testValue')
        );
        
        $this->entityTestLoop($entity, $individual_fields, $entity_fields);
    }

    public function testAttribute()
    {
        $entity = Entities\Attribute::class;

        $individual_fields = array(
            'Property'  => 'testValue',
            'Value'     => 'testValue'
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }

    public function testAttributeList()
    {
        $entity = Entities\AttributesList::class;
        
        $entity_fields = array(
            'Attribute' => array('Property' => 'testValue')
        );
        
        $this->entityTestLoop($entity, null, $entity_fields);
    }

    public function testCompanyData()
    {
        $entity = Entities\CompanyData::class;

        $individual_fields = array(
            'CompanyName'   => 'testValue',
            'Department'    => 'testValue',
            'VATNumber'     => 'testValue',
            'CoCNumber'     => 'testValue'
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }

    public function testEANList()
    {
        $entity = Entities\EANList::class;

        $individual_fields = array(
            'EAN'    => array('testValue', 'testValue', 'testValue')
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }

    public function testFeed()
    {
        $entity = Entities\Feed::class;

        $individual_fields = array(
            'RequestID' => 'testValue',
            'StatusID'  => 'testValue',
            'Status'    => 'testValue'
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }

    public function testFeedResult()
    {
        $entity = Entities\FeedResult::class;

        $individual_fields = array(
            'RequestID' => 'testValue',
            'StatusID'  => 'testValue',
            'Status'    => 'testValue'
        );
        
        $entity_fields = array(
            'Response' => array('Message' => 'testValue')
        );
        
        $this->entityTestLoop($entity, $individual_fields, $entity_fields);        
    }

    public function testOrder()
    {
        $entity = Entities\Order::class;

        $individual_fields = array(
            'OrderID'                   => 'testValue',
            'ReasonCode'                => 'testValue',
            'PurchaseDate'              => 'testValue',
            'Status'                    => 'testValue',
            'ChannelID'                 => 'testValue',
            'IsBusinessOrder'           => true,
            'NumberOfShipments'         => 5,
            'NumberOfItemsShipped'      => 5,
            'NumberOfItemsUnshipped'    => 5
        );
        
        $entity_fields = array(
            'Address'       => array('SalutationCode' => 'testValue'),
            'OrderTotal'    => array('Currency' => 'EUR'),
            'OrderLines'    => array('OrderLine' => array('Type' => 'testValue'))
        );
        
        $this->entityTestLoop($entity, $individual_fields, $entity_fields);    
    }

    public function testOrderLine()
    {
        $entity = Entities\OrderLine::class;

        $individual_fields = array(
            'Type'              => 'testValue',
            'OrderLineID'       => 'testValue',
            'VleksID'           => 'testValue',
            'SKU'               => 'testValue',
            'QuantityOrdered'   => 5,
            'QuantityShipped'   => 5,
            'Title'             => 'testValue'
        );
        
        $entity_fields = array(
            'ItemPrice'     => array('Currency' => 'EUR')
        );
        
        $this->entityTestLoop($entity, $individual_fields, $entity_fields);   
    }

    public function testOrderLines()
    {
        $entity = Entities\OrderLines::class;
        
        $entity_fields = array(
            'OrderLine' => array('Type' => 'testValue')
        );
        
        $this->entityTestLoop($entity, null, $entity_fields);   
    }

    public function testPrice()
    {
        $entity = Entities\Price::class;

        $individual_fields = array(
            'Currency'      => 'testValue',
            'Amount'        => 5.5
        );        
        
        $this->entityTestLoop($entity, $individual_fields);   
    }

    public function testPriceAndPercentage()
    {
        $entity = Entities\PriceAndPercentage::class;

        $individual_fields = array(
            'Currency'      => 'testValue',
            'Amount'        => 5.5,
            'Percentage'    => 5.5
        );        
        
        $this->entityTestLoop($entity, $individual_fields); 
    }

    public function testProduct()
    {
        $entity = Entities\Product::class;

        $individual_fields = array(
            'VleksID'         => 'testValue',
            'SKU'             => 'testValue',
            'Condition'       => 'testValue',
            'Reference'       => 'testValue',
            'MinDeliveryTime' => 5,
            'MaxDeliveryTime' => 5,
            'Title'           => 'testValue',
            'Brand'           => 'testValue',
            'ItemType'        => 'testValue',
            'Description'     => 'testValue',
            'Active'          => true,
            'Height'          => 5,
            'Width'           => 5,
            'Length'          => 5,
            'Weight'          => 5,
            'TaxPercentage'   => 'testValue'
        );
        
        $entity_fields = array(
            'EANList'           => array('testValue', 'testValue', 'testValue'),
            'PurchasePrice'     => array('Currency' => 'testValue', 'Amount' => 5.5),
            'Marge'             => array('Currency' => 'testValue', 'Amount' => 5.5, 'Percentage' => 5.5),
            'OverheadCosts'     => array('Currency' => 'testValue', 'Amount' => 5.5, 'Percentage' => 5.5),
            'HandlingCosts'     => array('Currency' => 'testValue', 'Amount' => 5.5, 'Percentage' => 5.5),
            'StorageCosts'      => array('Currency' => 'testValue', 'Amount' => 5.5, 'Percentage' => 5.5),
            'MarketingCosts'    => array('Currency' => 'testValue', 'Amount' => 5.5, 'Percentage' => 5.5),
            'MinPrice'          => array('Currency' => 'testValue', 'Amount' => 5.5),
            'MaxPrice'          => array('Currency' => 'testValue', 'Amount' => 5.5),
            'SalePrice'         => array('Currency' => 'testValue', 'Amount' => 5.5),
            'OfferPrice'        => array('Currency' => 'testValue', 'Amount' => 5.5),
            'Attributes'        => array('Value'    => 'testValue'),
            'Stock'             => array('StockLocation' => array('StoreID' => 'testValue')),
            'Store'             => array('StoreID'  => array('StoreID' => 'testValue'))
        );
        
        $this->entityTestLoop($entity, $individual_fields, $entity_fields);  
    }

    public function testResponse()
    {
        $entity = Entities\Response::class;
        
        $individual_fields = array(
            'Message'       => 'testValue',
            'OrderID'       => 'testValue',
            'ShipmentID'    => 'testValue',
            'VleksID'       => 'testValue',
            'RequestID'     => 'testValue',
            'SKU'           => 'testValue',
            'EAN'           => 'testValue',
            'Status'        => 'testValue'
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }

    public function testShipment()
    {
        $entity = Entities\Shipment::class;

        $individual_fields = array(
            'ShipmentID'    => 'testValue',
            'OrderID'       => 'testValue',
            'SendDate'      => 'testValue'
        );
        
        $entity_fields = array(
            'Transport'     => array('TransporterCode' => 'testValue', 'TrackAndTrace' => 'testValue'),
            'Address'       => array('SalutationCode' => 'testValue'),
            'OrderLines'    => array('OrderLine' => array('Type' => 'testValue'))
        );
        
        $this->entityTestLoop($entity, $individual_fields, $entity_fields);  
    }

    public function testStockList()
    {
        $entity = Entities\Stocklist::class;
        
        $entity_fields = array(
            'StockLocation' => array('LocationID' => 'testValue', 'QuantityInStock' => 5)
        );
        
        $this->entityTestLoop($entity, null, $entity_fields); 
    }

    public function testStockLocation()
    {
        $entity = Entities\StockLocation::class;

        $individual_fields = array(
            'LocationID'        => 'testValue',
            'QuantityInStock'   => 5
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }

    public function testStoreList()
    {
        $entity = Entities\StoreList::class;

        $individual_fields = array(
            'StoreID'   => array('testValue')
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }

    public function testTransport()
    {
        $entity = Entities\Transport::class;

        $individual_fields = array(
            'TransporterCode'   => 'testValue',
            'TrackAndTrace'     => 'testValue'
        );
        
        $this->entityTestLoop($entity, $individual_fields);
    }
}
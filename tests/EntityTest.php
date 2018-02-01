<?php

use PHPUnit\Framework\TestCase;
use Vleks\SDK\Entities;

class EntityTest extends TestCase
{
    public function testAddressData()
    {
        $addressData = new Entities\AddressData();

        // Test individual methods
        $addressData->setSalutationCode('testValue');
        $this->assertTrue($addressData->hasSalutationCode());
        $this->assertEquals($addressData->getSalutationCode(), 'testValue');
        $this->assertEquals($addressData->SalutationCode, 'testValue');

        $addressData->setFirstName('testValue');
        $this->assertTrue($addressData->hasFirstname());
        $this->assertEquals($addressData->getFirstName(), 'testValue');
        $this->assertEquals($addressData->FirstName, 'testValue');

        // Test nested entities
        $this->assertFalse($addressData->hasCompany());
        $addressData->setCompany(array('CompanyName' => 'testValue'));
        $this->assertTrue($addressData->hasCompany());
        $this->assertInternalType('array', $addressData->getCompany());

        // Test direct creation of entity
        $addressData = new Entities\AddressData(array (
            'SalutationCode' => 'testValue'
        ));

        $this->assertTrue($addressData->hasSalutationCode());
        $this->assertEquals($addressData->getSalutationCode(), 'testValue');
    }

    public function testAttribute()
    {
        //
    }

    public function testAttributeList()
    {
        //
    }

    public function testCompanyData()
    {
        //
    }

    public function testEANList()
    {
        //
    }

    public function testFeed()
    {
        //
    }

    public function testOrder()
    {
        //
    }

    public function testOrderLine()
    {
        //
    }

    public function testPrice()
    {
        //
    }

    public function testPriceAndPercentage()
    {
        //
    }

    public function testProduct()
    {
        //
    }

    public function testShipment()
    {
        //
    }

    public function testStockList()
    {
        //
    }

    public function testStockLocation()
    {
        //
    }

    public function testStoreList()
    {
        //
    }

    public function testTransport()
    {
        //
    }
}
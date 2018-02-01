<?php

use PHPUnit\Framework\TestCase;
use Vleks\SDK\Client;
use Vleks\SDK\Results;
use Vleks\SDK\Requests;
use Vleks\SDK\Entities;
use Vleks\SDK\Exceptions;
use Vleks\SDK\Enumerables;

class ClientTest extends TestCase
{
    /**
     * @var Vleks\BolPlazaSDK\Client
     */
    private $client;

    public function setUp()
    {
        $merchantId = getenv('MERCHANT_ID');
        $clusterUrl = getenv('API_CLUSTER');
        $publicKey  = getenv('API_PUBLIC_KEY');
        $privateKey = getenv('API_PRIVATE_KEY');

        $this->client = new Client(
            $publicKey,
            $privateKey,
            $merchantId,
            $clusterUrl
        );

        // $this->client->setTestMode(true);
    }

    public function createTestProduct()
    {
        return new Entities\Product(array (
            'SKU'             => 'SDK.P.001',
            'EANList'         => array (
                'EAN' => array (
                    '1966819785004',
                    '1966819785011',
                    '1966819785028',
                    '1966819785035',
                    '1966819785042',
                    '1966819785059'
                )
            ),
            'Condition'       => CONDITION_NEW,
            'Reference'       => '4922001',
            'MinDeliveryTime' => 24,
            'MaxDeliveryTime' => 48,
            'PurchasePrice'   => array (
                'Currency' => Enumerables\Currency::EUR,
                'Amount'   => 12.95
            ),
            'MinPrice'        => array (
                'Currency' => Enumerables\Currency::EUR,
                'Amount'   => 23
            ),
            'MaxPrice'        => array (
                'Currency' => Enumerables\Currency::EUR,
                'Amount'   => 42.95
            ),
            'SalePrice'       => array (
                'Currency' => 'EUR',
                'Amount'   => 25.99
            ),
            'Title'           => 'Opeflex SDK P001',
            'Brand'           => 'Opeflex',
            'ItemType'        => 'Fictive Product',
            'Description'     => '<p>
                <strong>Lorem ipsum dolor sit amet<strong><br />
                Consectetur adipiscing elit. Pellentesque et justo risus. Etiam luctus massa sit amet lorem molestie consectetur.
            </p>',
            'Active'          => true,
            'TaxPercentage'   => 21.0,
            'Attributes'      => array (
                'Attribute' => array (
                    array (
                        'Property' => 'adult',
                        'Value'    => 'no'
                    ),
                    array (
                        'Property' => 'product_link',
                        'Value'    => 'http://www.domain.ltd/product/sdk-p-001.html'
                    ),
                    array (
                        'Property' => 'product_image',
                        'Value'    => 'https://picsum.photos/1000/1000'
                    ),
                    array (
                        'Property' => 'additional_product_image',
                        'Value'    => 'https://picsum.photos/g/1000/1000'
                    ),
                    array (
                        'Property' => 'is_testproduct',
                        'Value'    => 'yes'
                    ),
                    array (
                        'Property' => 'usp_1',
                        'Value'    => 'Phasellus eu blandit nisl. Sed.'
                    ),
                    array (
                        'Property' => 'usp_2',
                        'Value'    => 'Suspendisse potenti. Vestibulum molestie urna.'
                    ),
                    array (
                        'Property' => 'usp_3',
                        'Value'    => 'Donec egestas felis quis velit.'
                    ),
                    array (
                        'Property' => 'usp_4',
                        'Value'    => 'Suspendisse eu tincidunt ante. Ut.'
                    ),
                    array (
                        'Property' => 'usp_5',
                        'Value'    => 'Praesent ultrices eleifend interdum. Proin.'
                    )
                )
            ),
            'Stock'           => array (
                'StockLocation' => array (
                    array (
                        'LocationID'      => 'B0000B0',
                        'QuantityInStock' => 2
                    )
                )
            )
        ));
    }

    public function testClient()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function testListProductsOptions()
    {
        $exceptionThrown = false;

        $request = new Requests\ListProducts();

        try {
            $request->setLimit(200);
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);

        $exceptionThrown = false;

        try {
            $request = new Requests\ListProducts(array('Limit' => 200));
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }

    public function testListProducts()
    {
        $request  = new Requests\ListProducts();
        $result   = $this->client->listProducts($request);
        $firstSet = array ();
        $lastSet  = array ();

        $this->assertInstanceOf(Requests\ListProducts::class, $request);
        $this->assertInstanceOf(Results\ListProducts::class, $result);
        $this->assertTrue($result->hasProduct());
        $this->assertEquals(count($result->getProducts()), 23);

        foreach ($result->getProducts() as $product) {
            array_push ($firstSet, $product->getVleksID());
        }

        $request = new Requests\ListProducts(array(
            'Offset' => 10,
            'Limit'  => 5
        ));
        $result  = $this->client->listProducts($request);

        $this->assertInstanceOf(Requests\ListProducts::class, $request);
        $this->assertInstanceOf(Results\ListProducts::class, $result);
        $this->assertTrue($result->hasProduct());
        $this->assertEquals(count($result->getProducts()), $request->Limit);

        foreach ($result->getProducts() as $product) {
            array_push ($lastSet, $product->getVleksID());
        }

        $this->assertEquals(array_slice ($firstSet, $request->Offset, $request->Limit), $lastSet);
    }

    public function testListSpecificProducts()
    {
        $request = new Requests\ListProducts();
        $request->setProducts(array(
            new Entities\Product(array('VleksID' => 'B0009TM')),
            new Entities\Product(array('VleksID' => 'B0009TN')),
            new Entities\Product(array('VleksID' => 'B0009TP')),
            new Entities\Product(array('VleksID' => 'B0009TQ')),
            new Entities\Product(array('VleksID' => 'B0009TR'))
        ));
        $result = $this->client->listProducts($request);

        $this->assertInstanceOf(Requests\ListProducts::class, $request);
        $this->assertInstanceOf(Results\ListProducts::class, $result);
        $this->assertTrue($result->hasProduct());
        $this->assertEquals(count($result->getProducts()), 5);
    }

    public function testAddProduct()
    {/*
        $request = new Requests\UpdateProducts();
        $request->setProducts(array (
            $this->createTestProduct()
        ));
        $result = $this->client->updateProducts($request);

        $this->assertInstanceOf(Requests\UpdateProducts::class, $request);
        $this->assertInstanceOf(Results\FeedStatus::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 1);
    */}

    public function testFeedStatus()
    {
        $request = new Requests\FeedStatus(array (
            'Feed' => array (
                array ('RequestID' => '7AEC5773-093B-4CBF-A31D-DA1ECC7480D4'),
                array ('RequestID' => '02D4CF3F-CB8A-4F8E-8F89-EF4E17059D05')
            )
        ));
        $result = $this->client->getFeedStatus($request);

        $this->assertInstanceOf(Requests\FeedStatus::class, $request);
        $this->assertInstanceOf(Results\FeedStatus::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 2);
        $this->assertEquals($result->getFeeds()[0]->getRequestID(), $request->getFeeds()[0]->getRequestID());
    }

    public function testFeedResults()
    {
        $request = new Requests\FeedResult(array (
            'Feed' => array (
                array ('RequestID' => '7AEC5773-093B-4CBF-A31D-DA1ECC7480D4'),
                array ('RequestID' => '02D4CF3F-CB8A-4F8E-8F89-EF4E17059D05')
            )
        ));
        $result = $this->client->getFeedResult($request);

        $this->assertInstanceOf(Requests\FeedResult::class, $request);
        $this->assertInstanceOf(Results\FeedResult::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 2);
        $this->assertEquals($result->getFeeds()[0]->getRequestID(), $request->getFeeds()[0]->getRequestID());
    }

    public function testListOrdersOptions() {

        $exceptionThrown = false;

        $request = new Requests\ListOrders();

        try {
            $request->setLimit(200);
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);

        $exceptionThrown = false;

        try {
            $request = new Requests\ListOrders(array('Limit' => 200));
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);

        $exceptionThrown = false;

        try {
            $request = new Requests\ListOrders(array ('Period' => '15-12-2017/17-01-2018'));
        } catch (Exceptions\ClientException $clientException) {

            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
        $exceptionThrown = false;

        try {
            $request = new Requests\ListOrders(array ('Period' => '01-01-2018/02-02-2018'));
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);

    }

    public function testListOrders() {

        $request  = new Requests\listOrders();
        $result   = $this->client->listOrders($request);
        $firstSet = array ();
        $lastSet  = array ();

        $this->assertInstanceOf(Requests\ListOrders::class, $request);
        $this->assertInstanceOf(Results\ListOrders::class, $result);
        $this->assertTrue($result->hasOrder());
        $this->assertEquals(count($result->getOrders()), 11);

        foreach ($result->getOrders() as $order) {
            array_push ($firstSet, $order->getOrderID());
        }

        $request = new Requests\ListOrders(array(
            'Offset' => 10,
            'Limit'  => 1
        ));
        $result  = $this->client->listOrders($request);

        $this->assertInstanceOf(Requests\ListOrders::class, $request);
        $this->assertInstanceOf(Results\ListOrders::class, $result);
        $this->assertTrue($result->hasOrder());
        $this->assertEquals(count($result->getOrders()), $request->getLimit());

        foreach ($result->getOrders() as $order) {
            array_push ($lastSet, $order->getOrderID());
        }

        $this->assertEquals(array_slice ($firstSet, $request->Offset, $request->Limit), $lastSet);

    }

    public function testListShipmentsOptions() {

        $exceptionThrown = false;

        $request = new Requests\ListShipments();

        try {
            $request->setLimit(200);
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);

        $exceptionThrown = false;

        try {
            $request = new Requests\ListShipments(array('Limit' => 200));
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);

    }

    public function testListShipments() {

        $request  = new Requests\ListShipments();
        $request->setShipment(array (
            new Entities\Shipment(array('OrderID' => 'B000PYW')),
            new Entities\Shipment(array('OrderID' => 'B000PYS'))
        ));
        $result   = $this->client->listShipments($request);
        $firstSet = array ();
        $lastSet  = array ();

        $this->assertInstanceOf(Requests\ListShipments::class, $request);
        $this->assertInstanceOf(Results\ListShipments::class, $result);
        $this->assertTrue($result->hasShipment());
        $this->assertEquals(count($result->getShipments()), 2);
    }

    // public function testListSpecificShipments()
    // {
        // $request = new Requests\ListShipments();
        // $request->setShipments(array(
            // new Entities\Shipment(array('OrderID' => 'B000PRX'))
        // ));
        // $result = $this->client->listShipments($request);
//
        // $this->assertInstanceOf(Requests\ListShipments::class, $request);
        // $this->assertInstanceOf(Results\ListShipments::class, $result);
        // $this->assertTrue($result->hasShipment());
        // $this->assertEquals(count($result->getShipments()), 5);
    // }
}

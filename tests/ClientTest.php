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

    public function testAddOrUpdateProduct()
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

    public function testDeleteProduct()
    {/*
        $request = new Requests\DeleteProducts();
        $request->setProducts(array (
            $this->createTestProduct()
        ));
        $result = $this->client->deleteProducts($request);

        $this->assertInstanceOf(Requests\DeleteProducts::class, $request);
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

    public function testCountOrdersOptions()
    {
        $exceptionThrown = false;
        $request = new Requests\CountOrders();
        
        try {
            $request->setPeriod('01-01-2018/02-02-2018');
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }
        
        $this->assertTrue($exceptionThrown);
        $exceptionThrown = false;
        
        try {
            $request->setPeriod('2018-01-30T09:00:00/2018-02-31T10:00:00');
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }
        
        $this->assertTrue($exceptionThrown);
        $exceptionThrown = false;
        
        try {
            $request = new Requests\CountOrders(array('Period' => '01-01-2018/02-02-2018'));
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }
        
        $this->assertTrue($exceptionThrown);
        $exceptionThrown = false;
        
        try {
            $request = new Requests\CountOrders(array('Period' => '2018-01-30T09:00:00/2018-02-31T10:00:00'));
        } catch (Exceptions\ClientException $clientException) {
            $exceptionThrown = true;
        }
        
        $this->assertTrue($exceptionThrown);
    }

    public function testCountOrders()
    {
        $request  = new Requests\CountOrders(array ('Period' => '2018-01-02T09:00:00/2018-02-01T10:00:00'));
        $result   = $this->client->countOrders($request);
        $count = $result->getCount();

        $this->assertInstanceOf(Requests\CountOrders::class, $request);
        $this->assertInstanceOf(Results\CountOrders::class, $result);
        $this->assertTrue($count->hasResult());

        $request  = new Requests\CountOrders(array ('Period' => '2010-01-02T09:00:00/2010-02-01T10:00:00'));
        $result  = $this->client->countOrders($request);
        $count = $result->getCount();

        $this->assertInstanceOf(Requests\CountOrders::class, $request);
        $this->assertInstanceOf(Results\CountOrders::class, $result);
        $this->assertTrue($count->hasResult());
        $this->assertEquals($count->getResult(), 0);
    }

    public function testCountProducts()
    {
        $request  = new Requests\CountProducts();
        $result   = $this->client->countProducts($request);
        $count = $result->getCount();

        $this->assertInstanceOf(Requests\CountProducts::class, $request);
        $this->assertInstanceOf(Results\CountProducts::class, $result);
        $this->assertTrue($count->hasResult());
    }

    public function testListOrdersOptions()
    {
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
            $request = new Requests\ListOrders(array ('Period' => '2018-01-30T09:00:00/2018-02-31T10:00:00'));
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

        $request  = new Requests\listOrders(array ('Period' => '2018-01-03T09:00:00/2018-02-01T10:00:00'));
        $result   = $this->client->listOrders($request);
        $firstSet = array ();
        $lastSet  = array ();

        $this->assertInstanceOf(Requests\ListOrders::class, $request);
        $this->assertInstanceOf(Results\ListOrders::class, $result);
        $this->assertTrue($result->hasOrder());
        // $this->assertEquals(count($result->getOrders()), 12);

        foreach ($result->getOrders() as $order) {
            array_push ($firstSet, $order->getOrderID());
        }

        $request = new Requests\ListOrders(array(
            'Offset' => 5,
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

    public function testRejectOrders()
    {/*
        $request = new Requests\RejectOrders(array(
            'Order' => array(
                array('OrderID' => 'B000PYQ')
            )
        ));
        $result = $this->client->rejectOrders($request);

        $this->assertInstanceOf(Requests\RejectOrders::class, $request);
        $this->assertInstanceOf(Results\FeedStatus::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 1);
    */}

    public function testAcceptOrders()
    {/*
        $request = new Requests\AcceptOrders(array(
            'Order' => array(
                array('OrderID' => 'B000PYR')
            )
        ));
        $result = $this->client->acceptOrders($request);

        $this->assertInstanceOf(Requests\AcceptOrders::class, $request);
        $this->assertInstanceOf(Results\FeedStatus::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 1);
    */}

    public function testCancelOrders()
    {/*
        $request = new Requests\CancelOrders(array(
            'Order' => array(
                array('OrderID' => 'B000PYR')
            )
        ));
        $result = $this->client->cancelOrders($request);

        $this->assertInstanceOf(Requests\CancelOrders::class, $request);
        $this->assertInstanceOf(Results\FeedStatus::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 1);
    */}

    public function testFinishOrders()
    {/*
        $request = new Requests\FinishOrders(array(
            'Order' => array(
                array('OrderID' => 'B000PY6')
            )
        ));
        $result = $this->client->finishOrders($request);

        $this->assertInstanceOf(Requests\FinishOrders::class, $request);
        $this->assertInstanceOf(Results\FeedStatus::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 1);
    */}

    public function testListShipmentsOptions()
    {
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

    public function testListShipments()
    {
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

    public function testAddShipment()
    {/*
        $request = new Requests\AddShipments(array (
            'Shipment' => array (
                array (
                    'OrderID'    => 'B000PX9',
                    'Transport'  => array (
                        'TransporterCode' => Enumerables\Transporter::DHL,
                        'TrackAndTrace'   => 'TrackAndTraceTestNumber'
                    ),
                    'Address'    => array (
                        'Firstname'   => 'V.',
                        'Surname'     => 'Leks',
                        'StreetName'  => 'Deventerweg',
                        'HouseNumber' => '2A',
                        'PostalCode'  => '3845 GD',
                        'City'        => 'Harderwijk',
                        'CountryCode' => Enumerables\CountryCode::NL
                    ),
                    'OrderLines' => array (
                        'OrderLine' => array (
                            array (
                                'OrderLineID'     => 'B00FRZ7',
                                'QuantityShipped' => 1
                            )
                        )
                    )
                )
            )
        ));
        $result = $this->client->addShipments($request);

        $this->assertInstanceOf(Requests\AddShipments::class, $request);
        $this->assertInstanceOf(Results\FeedStatus::class, $result);
        $this->assertTrue($result->hasFeeds());
        $this->assertEquals(count($result->getFeeds()), 1);
    */}
}

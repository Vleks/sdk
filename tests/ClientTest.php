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
        $this->assertEquals(count($result->getProducts()), 22);

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

<?php
use PHPUnit\Framework\TestCase;
use Vleks\SDK\Client;
use Vleks\SDK\Results;
use Vleks\SDK\Requests;
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
        $this->assertEquals(count($result->getProducts()), 100);

        foreach ($result->getProducts() as $product) {
            array_push ($firstSet, $product->getVleksID());
        }

        $request = new Requests\ListProducts(array(
            'Offset' => 50,
            'Limit'  => 10
        ));
        $result  = $this->client->listProducts($request);

        $this->assertInstanceOf(Requests\ListProducts::class, $request);
        $this->assertInstanceOf(Results\ListProducts::class, $result);
        $this->assertTrue($result->hasProduct());
        $this->assertEquals(count($result->getProducts()), 10);

        foreach ($result->getProducts() as $product) {
            array_push ($lastSet, $product->getVleksID());
        }

        $this->assertEquals(array_slice ($firstSet, $request->Offset, $request->Limit), $lastSet);
    }
}

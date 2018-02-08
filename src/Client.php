<?php namespace Vleks\SDK;

use Vleks\SDK\Results;
use Vleks\SDK\Requests;
use Vleks\SDK\Exceptions;
use Vleks\SDK\Enumerables;

class Client
{
    const VERSION         = '2.0.0';
    const ENDPOINT        = 'https://%s/api/vleks/2017-05/';
    const MESSAGE_HEADERS = 'HEADERS';
    const MESSAGE_BODY    = 'BODY';

    private $clusterUrl;
    private $merchantId;
    private $publicKey;
    private $privateKey;
    private $testMode            = false;
    private $skipSslVerification = false;
    private $responseHeaders;
    private $max_retries         = 3;

    public function __construct(
        $publicKey,
        $privateKey,
        $merchantId,
        $clusterUrl
    ) {
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
        $this->merchantId = $merchantId;
        $this->clusterUrl = $clusterUrl;
    }

    ############################################################################
    # API ENDPOINT METHODS
    ############################################################################

    /**
     * List available products
     *
     * @param   Vleks\SDK\Requests\ListProducts $request
     * @return  Vleks\SDK\Results\ListProducts
     */
    public function listProducts($request)
    {
        if (!$request instanceof Requests\ListProducts) {
            $request = new Requests\ListProducts($request);
        }

        $response = $this->invoke($this->convertListProductsRequest($request));
        $result   = Results\ListProducts::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Count Products
     *
     * @param   Vleks\SDK\Requests\CountProducts   $request
     * @return  Vleks\SDK\Results\CountProducts
     */
    public function countProducts($request)
    {
        if (!$request instanceof Requests\CountProducts) {
            $request = new Requests\CountProducts($request);
        }

        $response = $this->invoke($this->convertCountProductsRequest($request));
        $result   = Results\CountProducts::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Insert/Update products
     *
     * @param   Vleks\SDK\Requests\UpdateProducts   $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function updateProducts($request)
    {
        if (!$request instanceof Requests\UpdateProducts) {
            $request = new Requests\UpdateProducts($request);
        }

        $response = $this->invoke($this->convertUpdateProductsRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Delete products
     *
     * @param   Vleks\SDK\Requests\DeleteProducts   $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function deleteProducts($request)
    {
        if (!$request instanceof Requests\DeleteProducts) {
            $request = new Requests\DeleteProducts($request);
        }

        $response = $this->invoke($this->convertDeleteProductsRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Get statusses of requested feeds (changes)
     *
     * @param   Vleks\SDK\Requests\FeedStatus   $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function getFeedStatus($request)
    {
        if (!$request instanceof Requests\FeedStatus) {
            $request = new Requests\FeedStatus($request);
        }

        $response = $this->invoke($this->convertFeedStatusRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Get results of requested feeds (changes)
     *
     * @param   Vleks\SDK\Requests\FeedResult   $request
     * @return  Vleks\SDK\Results\FeedResult
     */
    public function getFeedResult($request)
    {
        if (!$request instanceof Requests\FeedResult) {
            $request = new Requests\FeedResult($request);
        }

        $response = $this->invoke($this->convertFeedResultRequest($request));
        $result   = Results\FeedResult::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * List Orders
     *
     * @param   Vleks\SDK\Requests\ListOrders   $request
     * @return  Vleks\SDK\Results\ListOrders
     */
    public function listOrders($request)
    {
        if (!$request instanceof Requests\ListOrders) {
            $request = new Requests\ListOrders($request);
        }

        $response = $this->invoke($this->convertListOrdersRequest($request));
        $result   = Results\ListOrders::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }
    
    /**
     * Count Orders
     *
     * @param   Vleks\SDK\Requests\CountOrders   $request
     * @return  Vleks\SDK\Results\CountOrders
     */
    public function countOrders($request)
    {
        if (!$request instanceof Requests\CountOrders) {
            $request = new Requests\CountOrders($request);
        }

        $response = $this->invoke($this->convertCountOrdersRequest($request));
        $result   = Results\CountOrders::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Reject Orders
     *
     * @param   Vleks\SDK\Requests\RejectOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function rejectOrders($request)
    {
        if (!$request instanceof Requests\RejectOrders) {
            $request = new Requests\RejectOrders($request);
        }

        $response = $this->invoke($this->convertRejectOrdersRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Accept Orders
     *
     * @param   Vleks\SDK\Requests\AcceptOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function acceptOrders($request)
    {
        if (!$request instanceof Requests\AcceptOrders) {
            $request = new Requests\AcceptOrders($request);
        }

        $response = $this->invoke($this->convertAcceptOrdersRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Cancel Orders
     *
     * @param   Vleks\SDK\Requests\CancelOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function cancelOrders($request)
    {
        if (!$request instanceof Requests\CancelOrders) {
            $request = new Requests\CancelOrders($request);
        }

        $response = $this->invoke($this->convertCancelOrdersRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Finish Orders
     *
     * @param   Vleks\SDK\Requests\FinishOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function finishOrders($request)
    {
        if (!$request instanceof Requests\FinishOrders) {
            $request = new Requests\FinishOrders($request);
        }

        $response = $this->invoke($this->convertFinishOrdersRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * List Shipments
     *
     * @param   Vleks\SDK\Requests\ListShipments    $request
     * @return  Vleks\SDK\Results\ListShipments
     */
    public function listShipments($request)
    {
        if (!$request instanceof Requests\ListShipments) {
            $request = new Requests\ListShipments($request);
        }

        $response = $this->invoke($this->convertListShipmentsRequest($request));
        $result   = Results\ListShipments::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    /**
     * Add Shipments
     *
     * @param   Vleks\SDK\Requests\AddShipments $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function addShipments($request)
    {
        if (!$request instanceof Requests\AddShipments) {
            $request = new Requests\AddShipments($request);
        }

        $response = $this->invoke($this->convertAddShipmentsRequest($request));
        $result   = Results\FeedStatus::fromXML($response['ResponseBody']);
        $result->setResponseHeaders($response['ResponseHeaders']);

        return $result;
    }

    ############################################################################
    # INFORMATION CONVERTION METHODS
    ############################################################################

    private function convertCountProductsRequest($request)
    {
        $messageHeaders = array (
            'Entity' => 'Product',
            'Action' => 'Count'
        );

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => null
        );
    }
    
    private function convertListProductsRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity'     => 'Product',
            'Action'     => 'List'
        );

        if ($request->hasLimit()) {
            $messageHeaders['Limit'] = $request->getLimit();
        }

        if ($request->hasOffset()) {
            $messageHeaders['Offset'] = $request->getOffset();
        }

        if ($request->hasProducts()) {
            $messageContent['Product'] = $request->getProducts();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertUpdateProductsRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Submit',
            'Type'   => 'Update'
        );

        if ($request->hasProducts()) {
            $messageContent['Product'] = $request->getProducts();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertDeleteProductsRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Submit',
            'Type'   => 'Delete'
        );

        if ($request->hasProducts()) {
            $messageContent['Product'] = $request->getProducts();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertFeedStatusRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Status'
        );

        if ($request->hasFeeds()) {
            $messageContent['Feed'] = $request->getFeeds();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertFeedResultRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Result'
        );

        if ($request->hasFeeds()) {
            $messageContent['Feed'] = $request->getFeeds();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }
    
    private function convertCountOrdersRequest($request)
    {
        $messageHeaders = array (
            'Entity' => 'Order',
            'Action' => 'Count'
        );

        if ($request->hasPeriod()) {
            $messageHeaders['Period'] = $request->getPeriod();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => null
        );
    }

    private function convertListOrdersRequest($request)
    {
        $messageHeaders = array (
            'Entity' => 'Order',
            'Action' => 'List'
        );

        if ($request->hasLimit()) {
            $messageHeaders['Limit'] = $request->getLimit();
        }

        if ($request->hasOffset()) {
            $messageHeaders['Offset'] = $request->getOffset();
        }

        if ($request->hasPeriod()) {
            $messageHeaders['Period'] = $request->getPeriod();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => null
        );
    }

    private function convertRejectOrdersRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Submit',
            'Type'   => 'Reject'
        );

        if ($request->hasOrders()) {
            $messageContent['Order'] = $request->getOrders();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertAcceptOrdersRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Submit',
            'Type'   => 'Accept'
        );

        if ($request->hasOrders()) {
            $messageContent['Order'] = $request->getOrders();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertCancelOrdersRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Submit',
            'Type'   => 'Cancel'
        );

        if ($request->hasOrders()) {
            $messageContent['Order'] = $request->getOrders();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertFinishOrdersRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Submit',
            'Type'   => 'Finish'
        );

        if ($request->hasOrders()) {
            $messageContent['Order'] = $request->getOrders();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertListShipmentsRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Shipment',
            'Action' => 'List'
        );

        if ($request->hasLimit()) {
            $messageHeaders['Limit'] = $request->getLimit();
        }

        if ($request->hasOffset()) {
            $messageHeaders['Offset'] = $request->getOffset();
        }

        if ($request->hasShipments()) {
            $messageContent['Shipment'] = $request->getShipments();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    private function convertAddShipmentsRequest($request)
    {
        $messageContent = array ();
        $messageHeaders = array (
            'Entity' => 'Feed',
            'Action' => 'Submit',
            'Type'   => 'Add'
        );

        if ($request->hasShipments()) {
            $messageContent['Shipment'] = $request->getShipments();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => $messageContent
        );
    }

    ############################################################################
    # CLIENT CONNECTION METHODS
    ############################################################################

    private function invoke(array $converted)
    {
        $envelopeHeaders = $converted[self::MESSAGE_HEADERS];
        $response        = array();
        $responseBody    = null;
        $statusCode      = 200;

        $envelopeHeaders = $this->addRequiredEnvelopeHeaders($envelopeHeaders);
        $converted[self::MESSAGE_HEADERS] = $envelopeHeaders;

        # Variables for retrying requests
        $shouldRetry     = false;
        $retries         = 0;

        do {
            $response    = $this->performRequest($converted);
            $statusCode  = $response['Status'];
            $shouldRetry = false;

            if(500 <= $statusCode) {

                # Will throw an exception if applicable, otherwise retry is allowed
                $this->reportAnyErrors($response['ResponseBody'], $response['Status'], $response['ResponseHeaders'], false);
                $shouldRetry = true;

                if($shouldRetry && $retries < $this->max_retries) {
                    $this->pauseOnRetry(++$retries);
                } else {
                    $shouldRetry = false;
                }
            }
        } while($shouldRetry);


        $this->reportAnyErrors($response['ResponseBody'], $response['Status'], $response['ResponseHeaders']);

        return array(
            'ResponseBody'    => $response['ResponseBody'],
            'ResponseHeaders' => $response['ResponseHeaders']
        );
    }

    private function pauseOnRetry($retries)
    {
        $delay = (int) (pow(4, $retries) * 100000);
        usleep($delay);
    }

    private function reportAnyErrors($responseBody, $status, array $responseHeaders, $checkFor500 = true)
    {
        if (false === $responseBody && empty($responseHeaders) && 0 === $status) {
            throw new Exceptions\ClientException('Unable to connect to the API, please check your configuration settings');
        }

        $throw     = false;
        $exception = array (
            'StatusCode'      => $status,
            'ResponseHeaders' => $responseHeaders
        );

        libxml_use_internal_errors(true);
        $xmlBody = simplexml_load_string($responseBody);

        if (false !== $xmlBody) {
            if (isset ($xmlBody->Error)) {
                $throw = true;

                $exception['XML']      = $responseBody;
                $exception['Severity'] = $xmlBody->Error->Severity;
                $exception['Message']  = $xmlBody->Error->Message;
            }

            if (isset ($xmlBody->Response)) {
                if (isset($xmlBody->Response->Severity)) {
                    switch ($xmlBody->Response->Severity) {
                        case E_ERROR:
                        case E_USER_ERROR:
                            $throw = true;

                            $exception['XML']      = $responseBody;
                            $exception['Severity'] = $xmlBody->Response->Severity;
                            $exception['Message']  = $xmlBody->Response->Message;
                            break;
                    }
                }
            }
        } elseif ($checkFor500) {
            if (500 <= $status) {
                $throw = true;

                $exception['Message'] = 'Internal Error';
            }
        }

        if ($throw) {
            throw new Exceptions\ServiceException($exception);
        }
    }

    private function performRequest(array $converted)
    {
        $curlOptions = $this->configureCurlOptions($converted);
        $curlClient  = curl_init();

        curl_setopt_array($curlClient, $curlOptions);

        $this->responseHeaders = @fopen('php://memory', 'rw+');

        $httpResponse = curl_exec($curlClient);
        $statusCode   = curl_getinfo($curlClient, CURLINFO_HTTP_CODE);

        rewind($this->responseHeaders);
        $responseHeaders = stream_get_contents($this->responseHeaders);
        $responseHeaders = $this->parseHttpHeader($responseHeaders);

        @fclose($this->responseHeaders);
        curl_close($curlClient);

        return array (
            'Status'          => $statusCode,
            'ResponseBody'    => $httpResponse,
            'ResponseHeaders' => $responseHeaders
        );
    }

    private function parseHttpHeader($header)
    {
        $parsedHeader = array();

        foreach (explode("\n", $header) as $line) {
            $splitLine = preg_split('/:\s/', $line, 2, PREG_SPLIT_NO_EMPTY);

            if (sizeof($splitLine) == 2) {
                $k = strtolower(trim($splitLine[0]));
                $v = trim($splitLine[1]);

                if (array_key_exists($k, $parsedHeader)) {
                    $parsedHeader[$k] = $parsedHeader[$k] . ',' . $v;
                } else {
                    $parsedHeader[$k] = $v;
                }
            }
        }

        return $parsedHeader;
    }

    private function headerCallback($curlClient, $string)
    {
        $bytesWritten = fwrite($this->responseHeaders, $string);
        return $bytesWritten;
    }

    private function configureCurlOptions(array $converted)
    {
        $cluserUrl   = sprintf(self::ENDPOINT, $this->clusterUrl);
        $postFields  = $this->buildXMLRequest($converted);
        $httpHeaders = $this->addRequiredHttpHeaders($postFields);

        $userAgent   = sprintf(
            'Vleks/%s (Language=PHP/%s; Platform=%s/%s/%s)',
            self::VERSION,
            phpversion(),
            php_uname('s'),
            php_uname('m'),
            php_uname('r')
        );

        $curlOptions = array(
            CURLOPT_URL            => $cluserUrl,
            CURLOPT_PORT           => 443,
            CURLOPT_USERAGENT      => $userAgent,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_HTTPHEADER     => $httpHeaders,
            CURLOPT_HEADERFUNCTION => array($this, 'headerCallback'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        );

        return $curlOptions;
    }

    private function addRequiredHttpHeaders($message)
    {
        $timestamp   = floor(microtime(true)/30);
        $contentType = 'application/xml; charset=UTF-8';

        $signatureBase  = "POST\n";
        $signatureBase .= $contentType . "\n";
        $signatureBase .= $timestamp . "\n";
        $signatureBase .= 'x-vleksapi-date:' . $timestamp . "\n";
        $signatureBase .= $message;

        $signature = sprintf('%s:%s', $this->publicKey, base64_encode(hash_hmac('SHA256', $signatureBase, $this->privateKey, true)));

        return array (
            'Content-Type: ' . $contentType,
            'X-VleksAPI-Date: ' . $timestamp,
            'X-VleksAPI-Signature: ' . $signature,
            'Expect: ',
            'Accept: ',
            'Transfer-Encoding: chunked'
        );
    }

    private function buildXMLRequest(array $converted) {
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
        $xml .= '<VleksRequest>';
        $xml .= '<Header>';

        foreach ($converted[self::MESSAGE_HEADERS] as $propertyName => $propertyValue) {
            $xml .= sprintf('<%1$s>%2$s</%1$s>', $propertyName, $propertyValue);
        }

        $xml .= '</Header>';

        if (!empty ($converted[self::MESSAGE_BODY])) {
            foreach ($converted[self::MESSAGE_BODY] as $propertyName => $propertyValue) {
                if (is_array ($propertyValue)) {
                    foreach ($propertyValue as $value) {
                        $xml .= sprintf('<%1$s>%2$s</%1$s>', $propertyName, $value->toXMLFragment());
                    }
                } else {
                    $xml .= sprintf('<%1$s>%2$s</%1$s>', $propertyName, $propertyValue->toXMLFragment());
                }
            }
        }

        $xml .= '</VleksRequest>';

        return $xml;
    }

    private function addRequiredEnvelopeHeaders($headers) {
        $default = array (
            'MerchantID' => $this->merchantId
        );

        return array_merge ($default, $headers);
    }
}

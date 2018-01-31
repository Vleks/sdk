<?php namespace Vleks\SDK;

use Vleks\SDK\Results;
use Vleks\SDK\Requests;
use Vleks\SDK\Exceptions;
use Vleks\SDK\Enumerables;

class Client
{
    const VERSION         = '0.1.0';
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

    public function setTestMode($mode = false)
    {
        $this->testMode = $mode;
    }

    public function skipSslVerification($mode = false)
    {
        $this->skipSslVerification = $mode;
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
     * List Orders 
     *
     * @param   Vleks\SDK\Requests\ListOrders $request
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
     * List Shipments 
     *
     * @param   Vleks\SDK\Requests\ListShipments $request
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

    ############################################################################
    # INFORMATION CONVERTION METHODS
    ############################################################################

    private function convertListProductsRequest($request)
    {
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

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => null
        );
    }
    
    private function convertListOrdersRequest($request)
    {
        $messageHeaders = array (
            'Entity'     => 'Order',
            'Action'     => 'List'
        );

        if ($request->hasLimit()) {
            $messageHeaders['Limit'] = $request->getLimit();
        }

        if ($request->hasOffset()) {
            $messageHeaders['Offset'] = $request->getOffset();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => null
        );
    }

    private function convertListShipmentsRequest($request)
    {
        $messageHeaders = array (
            'Entity'     => 'Shipment',
            'Action'     => 'List'
        );

        if ($request->hasLimit()) {
            $messageHeaders['Limit'] = $request->getLimit();
        }

        if ($request->hasOffset()) {
            $messageHeaders['Offset'] = $request->getOffset();
        }

        return array(
            self::MESSAGE_HEADERS => $messageHeaders,
            self::MESSAGE_BODY    => null
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

        $response   = $this->performRequest($converted);
        $statusCode = $response['Status'];

        $this->reportAnyErrors($response['ResponseBody'], $response['Status'], $response['ResponseHeaders']);

        return array(
            'ResponseBody'    => $response['ResponseBody'],
            'ResponseHeaders' => $response['ResponseHeaders']
        );
    }

    private function reportAnyErrors($responseBody, $status, array $responseHeaders)
    {
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
        } else {
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
            CURLOPT_SSL_VERIFYPEER => !$this->skipSslVerification,
            CURLOPT_SSL_VERIFYHOST => !$this->skipSslVerification ? 2 : 0
        );

        return $curlOptions;
    }

    private function addRequiredHttpHeaders($message)
    {
        $requestDate = gmdate('Y-m-d\TH:i:s\Z');
        $contentType = 'application/xml; charset=UTF-8';

        $signatureBase  = "POST\n";
        $signatureBase .= $contentType . "\n";
        $signatureBase .= $requestDate . "\n";
        $signatureBase .= 'x-vleksapi-date:' . $requestDate . "\n";
        $signatureBase .= $message;

        $signature = sprintf('%s:%s', $this->publicKey, base64_encode(hash_hmac('SHA256', $signatureBase, $this->privateKey, true)));

        return array (
            'Content-Type: ' . $contentType,
            'X-VleksAPI-Date: ' . $requestDate,
            'X-VleksAPI-Signature: ' . $signature
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

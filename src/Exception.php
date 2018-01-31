<?php namespace Vleks\SDK;

use \Exception as GenericException;

class Exception extends GenericException
{
    protected $message;

    private $statusCode = -1;
    private $severity;
    private $xml;
    private $responseHeaders;

    public function __construct(array $errorInfo = array())
    {
        $this->message = $errorInfo['Message'];

        parent::__construct($this->message);

        if (isset ($errorInfo['StatusCode'])) {
            $this->statusCode = (int) $errorInfo['StatusCode'];
        }

        if (isset ($errorInfo['Severity'])) {
            $this->severity = (int) $errorInfo['Severity'];
        }

        if (isset ($errorInfo['XML'])) {
            $this->xml = $errorInfo['XML'];
        }

        if (isset ($errorInfo['ResponseHeaders'])) {
            $this->responseHeaders = $errorInfo['ResponseHeaders'];
        }
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getSeverity()
    {
        return $this->severity;
    }

    public function getXML()
    {
        return $this->xml;
    }

    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }
}

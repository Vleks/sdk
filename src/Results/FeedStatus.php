<?php namespace Vleks\SDK\Results;

use \DOMXPath;
use \DOMDocument;
use Vleks\SDK\Model;
use Vleks\SDK\Entities\Feed;
use Vleks\SDK\Exceptions\ClientException;

class FeedStatus extends Model
{
    /**
     * Construct new Vleks\SDK\Results\FeedStatus
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Feed'            => array ('value' => array (), 'type' => array(Feed::class)),
            'ResponseHeaders' => array ('value' => array (), 'type' => 'array')
        );

        parent::__construct($data);
    }

    /**
     * Construct new Vleks\SDK\Results\FeedStatus from XML string
     *
     * @param   string  $xml
     * @return  object  Vleks\SDK\Results\FeedStatus
     * @throws  Vleks\SDK\Exceptions\ClientException
     */
    public function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $xpath    = new DOMXPath($dom);
        $response = $xpath->query('//VleksResponse');

        if (1 === $response->length) {
            return new FeedStatus($response->item(0));
        } else {
            throw new ClientException('Unable to construct FeedStatus response from provided XML.');
        }
    }

    /**
     * Sets the value of the Feed property
     *
     * @param   array   $value
     * @return  this instance
     */
    public function setFeed(array $value)
    {
        $this->fields['Feed']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the Feed property
     *
     * @return  array   Feed property value
     */
    public function getFeed()
    {
        return $this->fields['Feed']['value'];
    }

    /**
     * Checks if the Feed property has been set
     *
     * @return  bool    True if the Feed property has been set, false otherwise
     */
    public function hasFeed()
    {
        return !empty($this->fields['Feed']['value']);
    }

    /**
     * Sets the ResponseHeaders property
     *
     * @param   array   $value
     * @return  this instance
     */
    public function setResponseHeaders(array $value)
    {
        $this->fields['ResponseHeaders']['value'] = $value;
        return $this;
    }

    /**
     * Gets the value of the ResponseHeaders property
     *
     * @return  array   ResponseHeaders property value
     */
    public function getResponseHeaders()
    {
        return $this->fields['ResponseHeaders']['value'];
    }

    /**
     * Checks if the ResponseHeaders property had been set
     *
     * @return  bool    True if the ResponseHeaders property has been set, false otherwise
     */
    public function hasResponseHeaders()
    {
        return !empty($this->fields['ResponseHeaders']['value']);
    }

    /**
     * Product property method aliasses for convenience
     */
    public function setFeeds(array $value)
    {
        return $this->setFeed($value);
    }

    public function getFeeds()
    {
        return $this->getFeed();
    }

    public function hasFeeds()
    {
        return $this->hasFeed();
    }
}

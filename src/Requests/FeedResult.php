<?php namespace Vleks\SDK\Requests;

use Vleks\SDK\Model;
use Vleks\SDK\Entities\Feed;

class FeedResult extends Model
{
    /**
     * Construct new Vleks\SDK\Requests\FeedResult
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (
            'Feed' => array ('value' => array (), 'type' => array (Feed::class))
        );

        parent::__construct($data);
    }

    /**
     * Gets the value of the Feed property
     *
     * @return  mixed   Feed property value
     */
    public function getFeed()
    {
        return $this->fields['Feed']['value'];
    }

    /**
     * Checks if the Feed property has been set
     *
     * return   bool    True if the Feed property has been set, false otherwise
     */
    public function hasFeed()
    {
        return !is_null($this->fields['Feed']['value']);
    }

    /**
     * Sets the value of the Feed property
     *
     * @param   int     $value
     * @return  this instance
     */
    public function setFeed(array $value)
    {
        $this->fields['Feed']['value'] = $value;
        return $this;
    }

    /**
     * Helper methods for convenience
     */
    public function getFeeds()
    {
        return $this->getFeed();
    }

    public function hasFeeds()
    {
        return $this->hasFeed();
    }

    public function setFeeds(array $value)
    {
        return $this->setFeed($value);
    }
}

<?php namespace Vleks\SDK\Requests;

use Vleks\SDK\Model as BaseModel;
use Vleks\SDK\Exceptions;

class CountProducts extends BaseModel
{
    /**
     * Construct new Vleks\SDK\Requests\CountProducts
     *
     * @param   mixed   $data   DOMElement or associative array to construct from
     * @return  void
     */
    public function __construct($data = null)
    {
        $this->fields = array (

        );

        parent::__construct($data);
    }
}

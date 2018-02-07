<?php namespace Vleks\SDK\Entities;

use Vleks\SDK\Model as BaseModel;

class Transport extends BaseModel
{
    public function __construct($data = null)
    {
        $this->fields = array (
            'TransporterCode'   => array ('value' => null, 'type' => 'string'),
            'TrackAndTrace'     => array ('value' => null, 'type' => 'string')
        );

        parent::__construct($data);
    }

    public function setTransporterCode ($value)
    {
        $this->fields['TransporterCode']['value'] = $value;
        return $this;
    }

    public function getTransporterCode ()
    {
        return $this->fields['TransporterCode']['value'];
    }

    public function hasTransporterCode()
    {
        return !is_null($this->fields['TransporterCode']['value']);
    }
    
    public function setTrackAndTrace ($value)
    {
        $this->fields['TrackAndTrace']['value'] = $value;
        return $this;
    }

    public function getTrackAndTrace ()
    {
        return $this->fields['TrackAndTrace']['value'];
    }

    public function hasTrackAndTrace()
    {
        return !is_null($this->fields['TrackAndTrace']['value']);
    }
}

<?php

namespace App;

use Exception;

class TimeOnDistanceHandicap 
{
    protected $boat;
    protected $race;

    public function __construct($boat, $race) 
    {
        $this->boat = $boat;
        $this->race = $race;

        $this->validate();
    }

    public function validate()
    {
        if( is_null($this->race->start())  )
        {
            throw new Exception('A race start time must be saved before using this handicap.');
        }

        if( is_null($this->race->distance())  )
        {
            throw new Exception('A race distance must be saved before using this handicap.');

        }
    }

    public function correctedTime($finish_time)
    {   
        $boat = $this->boat;
        $race = $this->race;

        $start_time = $race->start();
        $elapsed_time = $finish_time - $start_time;

        $corrected_time = $elapsed_time - ($boat->phrfRating() * $race->distance());

        return $corrected_time;
    }

}
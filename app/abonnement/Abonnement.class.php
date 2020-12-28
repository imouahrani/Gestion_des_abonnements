<?php

/**
 * Description of Appareil
 *
 * @author Marcellin DBFX
 */
 
class Abonnement{
    
    private $type;
    private $volume;
    private $description;
    
    function __construct($type, $volume, $description) {
        $this->type = $type;
        $this->volume = $volume;
        $this->description = $description;
    }
    public function getType() {
        return $this->type;
    }

    public function getVolume() {
        return $this->volume;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setVolume($volume) {
        $this->volume = $volume;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

}

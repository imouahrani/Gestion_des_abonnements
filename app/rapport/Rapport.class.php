<?php

/**
 * Description of Phone
 *
 * @author Marcellin DBFX
 */
class Rapport{
    
    private $type;
    private $description;
    private $date_r;
    private $abonnement_id;
            
    function __construct($type, $description, $date_r, $abonnement_id) {
        $this->type = $type;
        $this->description = $description;
        $this->date_r = $date_r;
        $this->abonnement_id = $abonnement_id;
    }
    public function getType() {
        return $this->type;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate_r() {
        return $this->date_r;
    }

    public function getAbonnement_id() {
        return $this->abonnement_id;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDate_r($date_r) {
        $this->date_r = $date_r;
    }

    public function setAbonnement_id($abonnement_id) {
        $this->abonnement_id = $abonnement_id;
    }

}

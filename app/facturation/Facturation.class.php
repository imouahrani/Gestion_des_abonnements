<?php

/**
 * Description of Phone
 *
 * @author Marcellin DBFX
 */
class Facturation{
    
    private $date_f;
    private $client_id;
    private $abonnement_id;
    
    function __construct($date_f, $client_id, $abonnement_id) {
        $this->date_f = $date_f;
        $this->client_id = $client_id;
        $this->abonnement_id = $abonnement_id;
    }
    
    public function getDate_f() {
        return $this->date_f;
    }

    public function getClient_id() {
        return $this->client_id;
    }

    public function getAbonnement_id() {
        return $this->abonnement_id;
    }

    public function setDate_f($date_f) {
        $this->date_f = $date_f;
    }

    public function setClient_id($client_id) {
        $this->client_id = $client_id;
    }

    public function setAbonnement_id($abonnement_id) {
        $this->abonnement_id = $abonnement_id;
    }
}

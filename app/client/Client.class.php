<?php

/**
 * Description of Client
 *
 * @author Marcellin DBFX
 */

class Client{

    private $nom;
    private $adresse;
    private $contacts;

    function __construct($nom, $adresse, $contacts) {
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->contacts = $contacts;
    }
    public function getNom() {
        return $this->nom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getContacts() {
        return $this->contacts;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setContacts($contacts) {
        $this->contacts = $contacts;
    }

}

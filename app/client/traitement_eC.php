<?php
include('../../control/functions.php');
require('Client.class.php');
if(isset($_POST['nom_c'])){

            $nom=getField($_POST['nom_c']);

            $volume=getField($_POST['volumeUD']);

            $tel=getField($_POST['tel']);
            $email=getField($_POST['mail']);
            $contact="{";
            $contact.="tel : ".$tel;
            $contact.=",";
            $contact.="email : ".$email;
            $contact.="}";

            $province=getField($_POST['province']);
            $ville=getField($_POST['ville']);
            $ch_adresse=getField($_POST['ch_adresse']);
            $adresse="{";
            $adresse.="province : ".$province. ",";
            $adresse.="ville : ".$ville.",";
            $adresse.="adresse :".$ch_adresse."}";

            $abonnement_id=getFieldFromAnyElse("abonnement" ,"volume", $volume , "id");

            $client = new Client($nom,$adresse,$contact);
            
			
			$table="client";
			$field="nom";
			if(verifierExistanceKey($table,$field,$nom)>0){
				echo "<script type='text/javascript'>alert('Ce client existe déjà!');</script>";
			}else{
				insertClient($client);
				
            	$nom=$client->getNom();
				$adresse=$client->getAdresse();
				$contact=$client->getContacts();
	
				$client_id=getClientId($nom, $adresse, $contact);
				insertFacturation($client_id, $abonnement_id);
	
				echo "<p class='alert labelInfo-success col-lg-offset-3'>Client enregistré</p>";
			}

}else {
            echo "Echec enregistrement. Veuillez réessayer!";
}

<?php

include('functions.php');
include('../app/phone/Phone.class.php');


if(isset($_POST['submit'])){
	$marque=getField($_POST['marque_ph']);
	$proprietaire=getField($_POST['proprietaire']);
	$num_jeton=getField($_POST['num_jeton']);
	$heure_entree=date('Y-m-d');
	$heure_sortie=date('Y-m-d');

	$phone = new Phone($marque,$proprietaire,$num_jeton,$heure_entree,$heure_sortie);
	
	insertPhone($phone);
	
}
?>
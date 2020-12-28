<?php

include('functions.php');
include('../app/appareil/Appareil.class.php');


if(isset($_POST['submit'])){
	$designation=getField($_POST['designation']);
	$nom_proprietaire=getField($_POST['nom_proprietaire']);
	$marque=getField($_POST['marque']);
	$observation=getField($_POST['observation']);
	$date_depot=date('Y-m-d');
	$date_retrait=date('Y-m-d');

	$appareil = new Appareil($designation,$nom_proprietaire,$marque,$observation,$date_depot,$date_retrait);
	
	insertAppareil($appareil);
	
}
?>
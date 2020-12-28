<?php

include('functions.php');
include('../app/s_energie/S_Energie.class.php');


if(isset($_POST['submit'])){
	$beneficiaire=getField($_POST['beneficiaire']);
	$heure_arrivee=date('Y-m-d');
	$heure_sortie=date('Y-m-d');

	$s_energie = new S_Energie($beneficiaire,$heure_arrivee,$heure_sortie);
	
	insertS_Energie($s_energie);
	
	
	
}
?>
<?php
session_start();
echo '<meta charset="utf-8">';
include('functions.php');
include('../app/reparation/Reparation.class.php');


if(isset($_POST['submit'])){
	$appareil=getField($_POST['designation']);
	$id_appareil=getField($_POST['id_appareil']);
	$etat_appareil=getField($_POST['etat_appareil']);
	$c_verification=getField($_POST['verification']);
	$c_reparation=getField($_POST['reparation']);
	$cout=$c_verification+$c_reparation;
	$reparateur=getField($_SESSION['username']);
	$date_reparation=date('d-m-Y');

	$reparation = new Reparation($appareil,$id_appareil, $reparateur, $cout, $etat_appareil, $date_reparation);
	
	$ver=verifierExistanceKey("reparations","id_appareil", $id_appareil);
	/*echo $ver;*/
	if($ver<1){
	insertReparation($reparation);
	}
	else{
	header('Location:../app/appareil/afficher_appareil.php?msg="Cet appareil est déjà en cour de réparation!"');
	}
	
}

<?php

include('functions.php');
include('../app/membre/Membre.class.php');


if(isset($_POST['submit'])){
	$nom=getField($_POST['nom']);
	$prenom=getField($_POST['prenom']);
	$ddn=getField($_POST['naissance']);
	$role=getField($_POST['role']);
	$user=getField($_POST['user']);
	$pass=sha1(getField($_POST['pass']));

	$membre = new Membre($nom,$prenom,$ddn,$role,$user,$pass);
	
	insertMembre($membre);
	
}
?>
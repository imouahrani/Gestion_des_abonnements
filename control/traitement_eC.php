<?php

include('functions.php');
include('../app/client/Client.class.php');


if(isset($_POST['submit'])){
	$nom=getField($_POST['nom']);
	$prenom=getField($_POST['prenom']);
	$genre=getField($_POST['genre']);
	$telephone=getField($_POST['tel']);
	$addresse=getField($_POST['addresse']);
	
	$client = new Client($nom,$prenom,$genre,$telephone,$addresse);
	
	insertClient($client);
	
}
?>
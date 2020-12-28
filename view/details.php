<?php
echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../app/style/css/style.css"/>';
$table=$_GET['q_table'];
$id=$_GET['q_id'];

$sQuery="SELECT *";
$sQuery.=" FROM ".$table;
$sQuery.=" WHERE id = ?";

include('../model/connexion.php');

$pQuery=$databaseConnection->prepare($sQuery);

$pQuery->execute(array(
$id
));

echo '<table border="0">';

while($data=$pQuery->fetch()){

	if($table=="appareil"){
	echo "<h1>Details de l'appareil : </h1><br/>";
	echo '<tr><td>'.$data['designation'].', marque : '.$data['marque'].'<td></tr>';
	echo '<tr><td>Appartenant à '.$data['nom_proprietaire'].'<td></tr>';
	echo '<tr><td>Symptomes : '.$data['observation'].'<td></tr>';
		
	}
	else if($table=="phone"){
	echo '<h1>Details du téléphone : </h1><br/>';
	echo '<tr><td>Téléphone de marque : '.$data['marque'].'<td></tr>';
	echo '<tr><td>Appartenant à '.$data['proprietaire'].'<td></tr>';
	echo '<tr><td>Etiqueté du jeton N° : '.$data['num_jeton'].'<td></tr>';
	echo '<tr><td>En charge depuis : '.$data['heure_Entree'].'<td></tr>';	
	}
	else{
	echo '<h1>Details du Client à la salle de travail : </h1><br/>';
	echo '<tr><td>Nom : '.$data['nom_beneficiaire'].'<td></tr>';
	echo '<tr><td>Travail à COTEC depuis '.$data['heure_Arrivee'].'<td></tr>';
		
	}
	
//echo $data['id'];

}
echo '</table>';
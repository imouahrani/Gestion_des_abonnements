<?php

include('../../control/functions.php');
	$q = $_REQUEST["q"];

	$hint = "";

	$sQuery="SELECT nom
		     FROM client
			";
	//Resultats de la DB
	$dbCon=connectDb();
	$sResult=$dbCon->query($sQuery);

	// Recuperation des suggestions, si $q different de ""
	if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    while($data=$sResult->fetch()) {
		$name=$data['nom'];
		if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = '<a href= "../client/client.php?client_id='.getFieldFromAnyElse("client", "nom",$name,"id").'">'.$name.'</a>';
            } else {
                $hint .= ', <a href= "../client/client.php?client_id='.getFieldFromAnyElse("client", "nom",$name,"id").'">'.$name.'</a>';
            }
        }

    }
}

	/* Affichage d'un message si pas des suggestion */
	echo $hint === "" ? "</br>"."Aucune suggestion : Client non trouvé, <a href='enregistrer_Client.php?not_in='>veuillez l'enregistrer</a>" : "Résultats ". $hint;

	?>
